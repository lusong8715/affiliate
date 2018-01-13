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
        'App\Console\Commands\bannerList',
        'App\Console\Commands\dealList',
        'App\Console\Commands\commissions',
        'App\Console\Commands\wgTransaction',
        'App\Console\Commands\repeatOrders',
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
        $schedule->command('shareasale:transactiondetail')->dailyAt('20:00')->runInBackground();
        $schedule->command('shareasale:weeklyprogress')->cron('0 19 * * 1')->runInBackground();
        $schedule->command('shareasale:weeklyprogress')->cron('0 19 * * 5')->runInBackground();
        $schedule->command('shareasale:affiliatetimespan')->cron('30 18 * * 1')->runInBackground();
        $schedule->command('shareasale:activitysummary')->cron('0 18 * * 1')->runInBackground();
        $schedule->command('shareasale:todayataglance')->dailyAt('19:40')->runInBackground();
        $schedule->command('shareasale:staterevenue')->cron('10 19 * * 1')->runInBackground();
        $schedule->command('shareasale:transactioneditreport')->cron('0 3 * * 1')->runInBackground();
        $schedule->command('shareasale:transactionvoidreport')->cron('30 3 * * 1')->runInBackground();
        $schedule->command('shareasale:ledger')->cron('0 21 * * 1')->runInBackground();
        $schedule->command('shareasale:bannerreport')->cron('0 5 * * 1')->runInBackground();
        $schedule->command('shareasale:bannerlist')->dailyAt('17:00')->runInBackground();
        $schedule->command('shareasale:deallist')->dailyAt('17:20')->runInBackground();
        $schedule->command('cj:commissions')->dailyAt('21:00')->runInBackground();
        $schedule->command('wg:transaction')->dailyAt('21:10')->runInBackground();
        $schedule->command('repeat:order')->hourly()->runInBackground();
    }
}
