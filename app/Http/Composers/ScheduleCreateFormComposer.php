<?php
namespace App\Http\Composers;

use App\Models\ScheduleType;
use Illuminate\View\View;

class ScheduleCreateFormComposer
{
    public function compose(View $view)
    {
        $scheduleList = ScheduleType::all();
        $view->with(compact('scheduleList'));
    }
}