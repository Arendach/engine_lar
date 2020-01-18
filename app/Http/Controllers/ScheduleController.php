<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreateDayRequest;
use App\Models\Bonus;
use App\Models\Payout;
use App\Models\Schedule;
use App\Models\ScheduleMonth;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function sectionMain(int $user = 0)
    {
        $user = user($user);

        abort_if(cannot('schedule') && $user->id != user()->id, 403);

        $schedules = ScheduleMonth::my()->orderByDesc('year')->get()->mapToGroups(function (ScheduleMonth $item) {
            return [$item->year => $item];
        });

        return view('schedule.main', compact('schedules', 'user'));
    }

    public function sectionView(ScheduleService $scheduleService, int $user = 0, int $month = null, int $year = null)
    {
        $user = user($user);

        if (user()->id != $user->id && cannot('schedule')) {
            abort(403);
        }

        $year = $year ? $year : date('Y');
        $month = $month ? $month : date('m');

        $scheduleService->createOrAbort($year, $month, $user->id);

        $schedules = ScheduleMonth::concrete($year, $month, $user->id)->first()->load('items');

        $holidays = $schedules->items->where('type', 'holiday')->count(); // робочих днів (фактичних)
        $working = $schedules->items->where('type', 'working')->count(); // у відпустці
        $vacation = $schedules->items->where('type', 'vacation')->count(); // робочих днів (фактичних)
        $hospital = $schedules->items->where('type', 'hospital')->count(); // лікарняних

        $price_month = $this->calculatePriceMonth($schedules);

        // Зарплата = Ставка за місяць + бонуси за додаткові дні + бонуси + бонуси за перевиконання годин - штрафи
        $salary = $price_month + $schedules->bonus + $schedules->for_car - $schedules->fine;

        $bonus = $this->getBonuses($schedules->items, $schedules->coefficient, $year, $month, $schedules->price_month);

        $data = [
            'schedules'   => $schedules,
            'bonus'       => $bonus,
            'salary'      => $salary,
            'bonuses'     => Bonus::fromMonth($year, $month, $user->id),
            'payouts'     => Payout::fromMonth($year, $month, $user->id),
            'working'     => $working,
            'holidays'    => $holidays,
            'vacation'    => $vacation,
            'hospital'    => $hospital,
            'price_month' => $price_month,
            'user'        => $user
        ];

        return view('schedule.view', $data);
    }

    public function section_users()
    {
        $data = [
            'title'       => 'Менеджери :: Звіти',
            'users'       => Schedule::getDistinctUsers(),
            'breadcrumbs' => [
                ['Менеджери', uri('user')],
                ['Графіки роботи']
            ]
        ];

        $this->view->display('schedule.users', $data);
    }

    public function actionUpdateDayForm(int $id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedule.forms.update_day', compact('schedule'));
    }

    public function actionCreateDayForm(CreateDayRequest $request)
    {
        return view('schedule.forms.create_day', $request->all());
    }

    public function action_update_head_form($post)
    {
        $data = Schedule::findMonth($post);
        $this->view->display('schedule.forms.update_head', ['data' => $data, 'title' => 'Редагувати дані']);
    }

    public function action_update_head($post)
    {
        Schedule::update($post, $post->id, 'work_schedule_month');

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function action_update_bonuses_form($post)
    {
        $data = Schedule::findMonth($post);
        $this->view->display('schedule.forms.update_bonuses', ['data' => $data, 'title' => 'Редагувати бонуси']);
    }

    public function action_update_bonuses($post)
    {
        Schedule::update($post, $post->id, 'work_schedule_month');

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function actionUpdateDay(Request $request)
    {
        Schedule::findOrFail($request->id)->update($request->all());
    }

    public function actionCreateDay(Request $request, ScheduleService $scheduleService)
    {
        $date = $request->year . '-' . month_valid($request->month) . '-' . month_valid($request->day);

        if (Schedule::where('date', $date)->where('user_id', $request->user_id)->count()) {
            return;
        }

        $scheduleService->create($request->year, $request->month, $request->user_id);

        $schedule = ScheduleMonth::concrete($request->year, $request->month, $request->user_id)->first();

        Schedule::create([
            'date'              => $date,
            'type'              => $request->type,
            'turn_up'           => $request->get('turn_up', 9),
            'went_away'         => $request->get('went_away', 17),
            'dinner_break'      => $request->get('dinner_break', 0),
            'user_id'           => $request->user_id,
            'schedule_month_id' => $schedule->id
        ]);
    }

    public function action_create_payout_form($post)
    {
        $data = [
            'title'      => 'Нова виплата',
            'year'       => $post->year,
            'month'      => $post->month,
            'user'       => $post->user,
            'max_payout' => $this->maxPayout($post->year, $post->month, $post->user)
        ];

        $this->view->display('schedule.forms.create_payout', $data);
    }

    public function action_update_payout_form($post)
    {
        $payout = Schedule::getOne($post->id, 'payouts');

        $data = [
            'title'      => 'Редагування виплати',
            'payout'     => Schedule::getOne($post->id, 'payouts'),
            'max_payout' => $this->maxPayout($payout->year, $payout->month, $payout->user)
        ];

        $this->view->display('schedule.forms.update_payout', $data);
    }

    public function action_create_payout($post)
    {
        if ($post->sum == 0) response(400, 'Сума не може бути нулем!');

        $post->date_payout = date('Y-m-d H:i:s');
        $post->author = user()->id;

        $payout_id = Schedule::insert($post, 'payouts');

        Reports::createPayout($post->sum, $payout_id, $post->user);

        response(200, 'Виплата вдало прийнята!');
    }

    public function action_update_payout($post)
    {
        if ($post->sum == 0) response(400, 'Сума не може бути нулем!');

        Schedule::update($post, $post->id, 'payouts');

        Reports::updatePayout($post->sum, $post->id);

        response(200, 'Виплату вдало відредаговано!');
    }

    public function action_delete_payout($post)
    {
        Reports::deletePayout($post->id);

        Schedule::delete($post->id, 'payouts');

        response(200, 'Виплата вдало видалена!');
    }

    public function actionCreateBonusForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id);

        return view('schedule.forms.create_bonus', compact('schedule'));
    }

    public function actionCreateBonus(int $id, float $sum)
    {

        Bonus::create([
            ''
        ]);

        $bean = R::findOne('work_schedule_month', '`year` = ? AND `month` = ? AND `user` = ?', [
            $post->year,
            $post->month,
            $post->user
        ]);

        $bean->bonus += $post->sum;

        R::store($bean);

        $bean = R::dispense('bonuses');

        $bean->data = '';
        $bean->type = 'bonus';
        $bean->sum = $post->sum;
        $bean->user_id = $post->user;

        $bean->date =
            (date('Y') == $post->year && date('m') == $post->month)
                ? date('Y-m-d H:i:s')
                : date('Y-m-t', strtotime($post->year . '-' . month_valid($post->month) . '-01')) . ' 23:59:59';

        $bean->source = 'other';

        R::store($bean);
    }

    public function action_update_bonus_form($post)
    {
        $data = [
            'bonus' => Schedule::getOne($post->id, 'bonuses'),
            'title' => 'Редагування бонуса',
            'post'  => $post
        ];

        $this->view->display('schedule.forms.update_bonus', $data);
    }

    public function action_update_bonus($post)
    {
        Schedule::updateBonus($post);

        response(200, DATA_SUCCESS_UPDATED);
    }

    // Бонуси за перепрацювання
    public function getBonuses($items, $coefficient, $year, $month, $price_month)
    {
        $over_full_hours = 0; // Кількість перепрацьованих годин
        $bonus_per_hour = 0; // бонус за перевиконання

        foreach ($items as $item) {
            // кількість перепрацьованих годин
            $b = ($item->went_away - $item->dinner_break - $item->turn_up) - 8;

            if ($b > 0) {
                $over_full_hours += $b * $coefficient;
                $bonus_per_hour += ($price_month / count_working_days($year, $month) / 8) * $b * $coefficient;
            }
        }

        return round($bonus_per_hour, 2);
    }

    public function maxPayout($year, $month, $user_id)
    {
        $items = get_object(Schedule::getUserWorkSchedule($year, $month, $user_id));

        $new = [];
        foreach ($items->schedules as $item) $new[date_parse($item->date)['day']] = $item;

        // Зарплата = Ставка за місяць + бонуси за додаткові дні + бонуси + бонуси за перевиконання годин - штрафи
        $salary = $this->calculate_price_month($items) + $items->bonus + $items->for_car - $items->fine;

        unset($items->schedules);

        $payouts_sum = Schedule::getPayoutsSum($year, $month, $user_id);

        return [
            'salary'      => $salary,
            'payouts_sum' => $payouts_sum,
            'max'         => $salary - $payouts_sum
        ];
    }

    private function calculatePriceMonth($schedules): float
    {
        $hour_price = $schedules->price_month / count_working_days($schedules->year, $schedules->month) / 8;

        $working_hours = 0; // робочих годин (фактичних)
        $up_working_hours = 0; // перепрацьовані години
        $hospital_hours = 0; // на лікарняному

        foreach ($schedules->items as $item) {

            // пропрацьовано годин цього дня
            $worked = $item->went_away - $item->turn_up - $item->dinner_break;

            if ($item->type == 1 || $item->type == 2) $working_hours += $worked;
            elseif ($item->type == 3) $hospital_hours += $worked;


            // підрахунок перепрацьованих годин
            if ($worked - 8 > 0) $up_working_hours += $worked - $item->work_day;
        }


        $h = $hour_price;
        $hh = $hospital_hours;

        if ($hh <= 24)
            $matrix = [$hh * $h];
        elseif ($hh > 24 && $hh <= 56)
            $matrix = [24 * $h, ($hh - 24) * $h * 0.8];
        elseif ($hh > 56 && $hh <= 120)
            $matrix = [24 * $h, 32 * $h * 0.8, ($hh - 56) * $h * 0.5];
        elseif ($hh > 120 && $hh <= 184)
            $matrix = [24 * $h, 32 * $h * 0.8, 64 * $h * 0.5, ($hh - 120) * $h * 0.3];
        else
            $matrix = [24 * $h, 32 * $h * 0.8, 64 * $h * 0.5, 64 * $h * 0.3, 0];

        $hospital_price = array_sum($matrix);


        // перерахування ставки
        $price_month = ($working_hours * $hour_price)
            - ($up_working_hours * $hour_price)
            + ($up_working_hours * $schedules->coefficient * $hour_price)
            + $hospital_price;

        $price_month = round($price_month, 2);

        view()->share('working_hours', $working_hours);
        view()->share('up_working_hours', $up_working_hours);
        view()->share('hour_price', $hour_price);
        view()->share('hospital_hours', $hospital_hours);

        return $price_month;
    }
}