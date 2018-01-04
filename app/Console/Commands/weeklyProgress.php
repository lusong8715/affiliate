<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class weeklyProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:weeklyprogress {--start=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Weekly Progress Report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $action = 'weeklyprogress';
        $param = array();
        if ($this->option('start')) {
            $start = strtotime($this->option('start'));
            $param['datestart'] = date('m/d/Y', $start);
        }
        if ($this->option('lengthofreport')) {
            $param['lengthofreport '] = $this->option('lengthofreport');
        } else {
            $param['lengthofreport '] = 7;
        }

        $output = \Aff_Helper::callSasApi($action, $param);
        if (!$output) {
            return;
        }

        $datas = simplexml_load_string($output);
        if ($datas) {
            foreach ($datas as $data) {
                $repDate = date('Y-m-d', strtotime($data->repdate));
                $wp = \App\Models\WeeklyProgress::where('rep_date', '=', $repDate)->get();
                if (!count($wp)) {
                    $wp = new \App\Models\WeeklyProgress();
                    $wp->rep_date = $repDate;
                }
                $wp->clicks = $data->clicks;
                $wp->gross_sales = preg_replace('/[^0-9.]+/', '', $data->grosssales);
                $wp->voids = $data->voids;
                $wp->net_sales = preg_replace('/[^0-9.]+/', '', $data->netsales);
                $wp->number_of_sales = $data->numberofsales;
                $wp->manual_credits = $data->manualcredits;
                $wp->commissions = preg_replace('/[^0-9.]+/', '', $data->commissions);
                $wp->affiliates = $data->affiliates;
                $wp->active_affiliates = $data->activeaffiliates;
                $wp->numb_sales = $data->numbsales;
                $wp->numb_leads = $data->numbleads;
                $wp->numb_two_tier = $data->numbtwotier;
                $wp->numb_bonuses = $data->numbbonuses;
                $wp->numb_pay_per_call = $data->numbpaypercall;
                $wp->numb_leapfrog = $data->numbleapfrog;
                $wp->sale_commissions = preg_replace('/[^0-9.]+/', '', $data->salecommissions);
                $wp->lead_commissions = preg_replace('/[^0-9.]+/', '', $data->leadcommissions);
                $wp->two_tier_commissions = preg_replace('/[^0-9.]+/', '', $data->twotiercommissions);
                $wp->bonus_commissions = preg_replace('/[^0-9.]+/', '', $data->bonuscommissions);
                $wp->pay_per_call_commissions = preg_replace('/[^0-9.]+/', '', $data->paypercallcommissions);
                $wp->leapfrog_commissions = preg_replace('/[^0-9.]+/', '', $data->leapfrogcommissions);
                $wp->save();
            }
        }
    }
}
