<?php

namespace App\Console;

use App\Console\Commands\MakeCast;
use App\Console\Commands\ReloadNewPostWarehouses;
use App\Console\Commands\ReportRelation;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ReloadNewPostWarehouses::class,
        ReportRelation::class,
        MakeCast::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
