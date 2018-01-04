<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class todayAtAGlance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:todayataglance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Today At A Glance';

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
        $action = 'todayataglance';
        $output = \Aff_Helper::callSasApi($action);
        if (!$output) {
            return;
        }

        $datas = simplexml_load_string($output);
        if ($datas) {
            DB::table('shareasale_todayataglance')->truncate();
            foreach ($datas as $data) {
                $taag = new \App\Models\TodayAtAGlance();
                $taag->affiliate = $data->affiliate;
                $taag->clicks = $data->clicks;
                $taag->gross_sales = preg_replace('/[^0-9.]+/', '', $data->grosssales);
                $taag->voids = $data->voids;
                $taag->net_sales = preg_replace('/[^0-9.]+/', '', $data->netsales);
                $taag->number_of_sales = $data->numberofsales;
                $taag->manual_credits = $data->manualcredits;
                $taag->commissions = preg_replace('/[^0-9.]+/', '', $data->commissions);
                $taag->conversion = $data->conversion;
                $taag->epc = $data->epc;
                $taag->average_order = $data->averageorder;
                $taag->numb_sales = $data->numbsales;
                $taag->numb_leads = $data->numbleads;
                $taag->numb_two_tier = $data->numbtwotier;
                $taag->numb_bonuses = $data->numbbonuses;
                $taag->numb_pay_per_call = $data->numbpaypercall;
                $taag->numb_leapfrog = $data->numbleapfrog;
                $taag->sale_commissions = preg_replace('/[^0-9.]+/', '', $data->salecommissions);
                $taag->lead_commissions = preg_replace('/[^0-9.]+/', '', $data->leadcommissions);
                $taag->two_tier_commissions = preg_replace('/[^0-9.]+/', '', $data->twotiercommissions);
                $taag->bonus_commissions = preg_replace('/[^0-9.]+/', '', $data->bonuscommissions);
                $taag->pay_per_call_commissions = preg_replace('/[^0-9.]+/', '', $data->paypercallcommissions);
                $taag->leapfrog_commissions = preg_replace('/[^0-9.]+/', '', $data->leapfrogcommissions);
                $taag->save();
            }
        }
    }
}
