<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('shareasale_config')->insert([
            'api_url' => 'https://api.shareasale.com/w.cfm',
            'api_token' => '',
            'api_secret' => '',
            'api_version' => '2.8',
        ]);

        DB::table('admin_menu')->insert(
            array(
                array(
                    'parent_id' => 0,
                    'order' => 12,
                    'title' => 'ShareASale',
                    'icon' => 'fa-bars',
                    'uri' => ''
                ),
                array(
                    'parent_id' => 12,
                    'order' => 1,
                    'title' => 'Config',
                    'icon' => 'fa-book',
                    'uri' => 'sasconfig'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 2,
                    'title' => 'Refunds Order',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasrefundsorder'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 3,
                    'title' => 'Transaction Detail',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sastransactiondetail'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 4,
                    'title' => 'Weekly Progress',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasweeklyprogress'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 5,
                    'title' => 'Affiliate Time Span',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasaffiliatetimespan'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 6,
                    'title' => 'Activity Summary',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasactivitysummary'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 7,
                    'title' => 'Today At A Glance',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sastodayataglance'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 8,
                    'title' => 'State Revenue',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasstaterevenue'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 9,
                    'title' => 'Transaction Edit Report',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sastransactioneditreport'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 10,
                    'title' => 'Transaction Void Report',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sastransactionvoidreport'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 11,
                    'title' => 'Ledger',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasledger'
                ),
                array(
                    'parent_id' => 12,
                    'order' => 12,
                    'title' => 'Banner Report',
                    'icon' => 'fa-bar-chart',
                    'uri' => 'sasbannerreport'
                ),
            )
        );
    }
}
