<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\CreateBonusRequest;
use App\Http\Requests\Schedule\CreateDayRequest;
use App\Http\Requests\Schedule\CreatePayoutRequest;
use App\Http\Requests\Schedule\UpdateBonusesRequest;
use App\Http\Requests\Schedule\UpdateBonusRequest;
use App\Http\Requests\Schedule\UpdateDayRequest;
use App\Http\Requests\Schedule\UpdateHeadRequest;
use App\Http\Requests\Schedule\UpdatePayoutRequest;
use App\Models\Bonus;
use App\Models\Payout;
use App\Models\Schedule;
use App\Models\ScheduleMonth;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScheduleController extends Controller
{
    // views
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

        abort_if(cannot('schedule') && $user->id != user()->id, 403);

        $year = $year ? $year : date('Y');
        $month = $month ? $month : date('m');

        $scheduleService->create($year, $month, $user->id);

        $schedules = ScheduleMonth::concrete($year, $month, $user->id)->first()->load('items');
        $holidays = $schedules->items->where('type', '1')->count(); // робочих днів (фактичних)
        $working = $schedules->items->where('type', '2')->count(); // у відпустці
        $vacation = $schedules->items->where('type', '3')->count(); // робочих днів (фактичних)
        $hospital = $schedules->items->where('type', '4')->count(); // лікарняних

        $priceMonth = $this->calculatePriceMonth($schedules);

        // Зарплата = Ставка за місяць + бонуси за додаткові дні + бонуси + бонуси за перевиконання годин - штрафи
        $salary = $priceMonth + $schedules->bonus + $schedules->for_car - $schedules->fine;

        $data = [
            'schedules'  => $schedules,
            'salary'     => $salary,
            'bonuses'    => Bonus::fromMonth($year, $month, $user->id)->get(),
            'payouts'    => Payout::fromMonth($year, $month, $user->id)->get(),
            'working'    => $working,
            'holidays'   => $holidays,
            'vacation'   => $vacation,
            'hospital'   => $hospital,
            'priceMonth' => $priceMonth,
            'user'       => $user
        ];

        return view('schedule.view', $data);
    }


    // days
    public function actionUpdateDayForm(int $id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedule.forms.update_day', compact('schedule'));
    }

    public function actionUpdateDay(UpdateDayRequest $request)
    {
        Schedule::findOrFail($request->id)->update($request->all());
    }

    public function actionCreateDayForm(int $id, int $day)
    {
        return view('schedule.forms.create_day', compact('id', 'day'));
    }

    public function actionCreateDay(CreateDayRequest $request)
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


    // head form
    public function actionUpdateHeadForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id);

        return view('schedule.forms.update_head', compact('schedule'));
    }

    public function actionUpdateHead(UpdateHeadRequest $request, int $id)
    {
        ScheduleMonth::findOrFail($id)->update($request->all());
    }

    // bonuses
    public function actionUpdateBonusesForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id);

        return view('schedule.forms.update_bonuses', compact('schedule'));
    }

    public function actionUpdateBonuses(UpdateBonusesRequest $request)
    {
        ScheduleMonth::findOrFail($request->id)->update($request->all());
    }

    public function actionCreateBonusForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id);

        return view('schedule.forms.create_bonus', compact('schedule'));
    }

    public function actionCreateBonus(CreateBonusRequest $request)
    {
        $schedule = ScheduleMonth::findOrFail($request->id);
        Bonus::create([
            'data'    => $request->id,
            'is_profit' => true,
            'sum'       => $request->sum,
            'user_id'   => $schedule->user_id,
            //'date'    => create_date_or_now($schedule->year, $schedule->month, 1, true),
            'source'    => 'other'
        ]);
    }

    public function actionUpdateBonusForm(int $id)
    {
        $bonus = Bonus::findOrFail($id);

        return view('schedule.forms.update_bonus', compact('bonus'));
    }

    public function actionUpdateBonus(UpdateBonusRequest $request)
    {
        Bonus::findOrFail($request->id)->update($request->all());
    }


    // Payouts
    public function actionCreatePayoutForm(int $id)
    {
        $schedule = ScheduleMonth::findOrFail($id)->load('items');

        $maxPayout = $this->maxPayout($schedule);

        return view('schedule.forms.create_payout', compact('maxPayout', 'schedule'));
    }

    public function actionUpdatePayoutForm(int $id)
    {
        $payout = Payout::findOrFail($id);
        $schedule = ScheduleMonth::concrete($payout->year, $payout->month, $payout->user_id)->firstOrFail();
        $maxPayout = $this->maxPayout($schedule);

        return view('schedule.forms.update_payout', compact('maxPayout', 'payout'));
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

    public function actionUpdatePayout(int $id, UpdatePayoutRequest $request)
    {
        Payout::findOrFail($id)->update($request->all());
    }

    public function actionDeletePayout(int $id)
    {
        Payout::findOrFail($id)->delete();
    }


    // calculates
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

    private function calculatePriceMonth(ScheduleMonth $schedules): float
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