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
        'App\Console\Commands\transactionEditReport',
        'App\Console\Commands\transactionVoidReport',
        'App\Console\Commands\ledger',
        'App\Console\Commands\bannerReport',
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
        $schedule->command('shareasale:transactiondetail')->dailyAt('08:00')->runInBackground();
        $schedule->command('shareasale:weeklyprogress')->cron('0 7 * * 1')->runInBackground();
        $schedule->command('shareasale:weeklyprogress')->cron('0 7 * * 5')->runInBackground();
        $schedule->command('shareasale:affiliatetimespan')->cron('0 2 * * 1')->runInBackground();
        $schedule->command('shareasale:activitysummary')->cron('0 2 * * 1')->runInBackground();
        $schedule->command('shareasale:todayataglance')->dailyAt('06:00')->runInBackground();
        $schedule->command('shareasale:staterevenue')->cron('0 2 * * 1')->runInBackground();
        $schedule->command('shareasale:transactioneditreport')->cron('0 3 * * 1')->runInBackground();
        $schedule->command('shareasale:transactionvoidreport')->cron('0 3 * * 1')->runInBackground();
        $schedule->command('shareasale:ledger')->cron('0 4 * * 1')->runInBackground();
        $schedule->command('shareasale:bannerreport')->cron('0 5 * * 1')->runInBackground();
    }
}
