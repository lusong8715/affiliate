<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\updateOrder',
        'App\Console\Commands\weeklyProgress',
        'App\Console\Commands\transactionDetail',
        'App\Console\Commands\affiliateTimeSpan',
        'App\Console\Commands\activitySummary',
        'App\Console\Commands\todayAtAGlance',
        'App\Console\Commands\stateRevenue',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:order')->dailyAt('09:00')->runInBackground();
    }
}
