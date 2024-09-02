<?php

namespace App\Console;

use App\Console\Commands\CheckUserSubscription;
use App\Console\Commands\DownloadPresentations;
use App\Console\Commands\EnableUserSubscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $command = [
        DownloadPresentations::class,
        CheckUserSubscription::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('download:presentations')->everyMinute();
        $schedule->command('user-rooms:check')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
