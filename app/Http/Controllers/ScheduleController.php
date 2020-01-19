<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreatePayoutRequest;
use App\Models\Bonus;
use App\Models\Payout;
use App\Models\Schedule;
use App\Models\ScheduleMonth;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScheduleController extends Controller
{
    public function sectionMain(int $user = 0)
    {
        $user = user($user);

        abort_if(cannot('schedule') && $user->id != user()->id, 403);

        $schedules = ScheduleMonth::where('user_id', $user->id)
            ->orderByDesc('year')
            ->get()
            ->mapToGroups(function (ScheduleMonth $item) {
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

        $scheduleService->create($year, $month, $user->id);

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
            'bonuses'     => Bonus::fromMonth($year, $month, $user->id)->get(),
            'payouts'     => Payout::fromMonth($year, $month, $user->id)->get(),
            'working'     => $working,
            'holidays'    => $holidays,
            'vacation'    => $vacation,
            'hospital'    => $hospital,
            'price_month' => $price_month,
            'user'        => $user
        ];

        return view('schedule.view', $data);
    }


    public function actionUpdateDayForm(int $id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedule.forms.update_day', compact('schedule'));
    }

    public function actionUpdateDay(Request $request)
    {
        Schedule::findOrFail($request->id)->update($request->all());
    }

    public function actionCreateDayForm(int $id, int $day)
    {
        return view('schedule.forms.create_day', compact('id', 'day'));
    }

    public function actionCreateDay(Request $request, ScheduleService $scheduleService)
    {
        $schedule = ScheduleMonth::findOrFail($request->get('id'));

        $date = create_date(year($schedule->date), month($schedule->date), $request->get('day'));

        if (Schedule::where('date', $date)->where('user_id', $request->user_id)->count()) {
            return;
        }

        Schedule::create([
            'date'              => $date,
            'type'              => $request->type,
            'turn_up'           => $request->get('turn_up', 9),
            'went_away'         => $request->get('went_away', 17),
            'dinner_break'      => $request->get('dinner_break', 0),
            'user_id'           => $schedule->user_id,
            'schedule_month_id' => $schedule->id
        ]);
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


    public function actionUpdateBonusesForm(Request $request)
    {
        $schedule = ScheduleMonth::findOrFail($request->id);

        return view('schedule.forms.update_bonuses', compact('schedule'));
    }

    public function actionUpdateBonuses(Request $request)
    {
        ScheduleMonth::findOrFail($request->id)->update($request->all());
    }


    public function actionCreatePayoutForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id)->load('items');

        $maxPayout = $this->maxPayout($schedule);

        return view('schedule.forms.create_payout', compact('maxPayout', 'schedule'));
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

    public function actionCreatePayout(CreatePayoutRequest $request)
    {
        $schedule = ScheduleMonth::findOrFail($request->id);

        Payout::create([
            'sum'         => $request->sum,
            'user_id'     => $schedule->user_id,
            'author_id'   => user()->id,
            'date_payout' => now(),
            'year'        => $schedule->year,
            'month'       => $schedule->month,
            'comment'     => $request->comment
        ]);
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
        $schedule = ScheduleMonth::findOrFail($id);

        Bonus::create([
            'type'    => 'bonus',
            'sum'     => $sum,
            'user_id' => $schedule->user_id,
            'date'    => create_date_or_now($schedule->year, $schedule->month, 1, true),
            'source'  => 'other'
        ]);
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
    private function getBonuses($items, $coefficient, $year, $month, $price_month)
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

    private function maxPayout(ScheduleMonth $schedule): Collection
    {
        // Зарплата = Ставка за місяць + бонуси за додаткові дні + бонуси + бонуси за перевиконання годин - штрафи
        $salary = $this->calculatePriceMonth($schedule) + $schedule->bonus + $schedule->for_car - $schedule->fine;

        $payoutsSum = Payout::fromMonth($schedule->year, $schedule->month, $schedule->user_id)->sum('sum');

        return new Collection([
            'salary'     => $salary,
            'payoutsSum' => $payoutsSum,
            'max'        => $salary - $payoutsSum
        ]);
    }

    public function calculatePriceMonth(ScheduleMonth $schedules): float
    {
        $hospitalPrice = $this->calculateHospitalPrice($schedules->hospital_hours, $schedules->hour_price);
        $workingPrice = $schedules->working_hours * $schedules->hour_price;
        $vacationPrice = $schedules->vacation_hours * $schedules->hour_price;
        $upWorkingPrice = $schedules->up_working_hours * $schedules->coefficient * $schedules->hour_price;

        return $hospitalPrice + $workingPrice + $vacationPrice + $upWorkingPrice;
    }

    private function calculateHospitalPrice(int $hospitalHours, float $hourPrice): float
    {
        $matrix = [
            1   => 24, // 0   - 24
            0.8 => 32, // 24  - 56
            0.5 => 64, // 56  - 120
            0.3 => 64  // 120 - 184
        ];
        $hospitalPrice = 0;
        foreach ($matrix as $coefficient => $hours) {
            // якшо лікарняних менше або рівно 0
            if ($hospitalHours <= 0) break;

            // якщо лікаарняних менше ніж годин з матриці
            if ($hospitalHours < $hours) $hours = $hospitalHours;

            // плюсуєм до зп
            $hospitalPrice += $hours * $coefficient * $hourPrice;

            // віднімаєм години
            $hospitalHours -= $hours;
        }

        return $hourPrice;
    }
}