<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class affiliateTimeSpan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:affiliatetimespan {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Affiliate Time Span';

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
        $action = 'affiliatetimespan';
        $param = array();
        if ($this->option('start')) {
            $start = strtotime($this->option('start'));
            $param['datestart'] = date('m/d/Y', $start);
        }
        if ($this->option('end')) {
            $end = strtotime($this->option('end'));
            $param['dateend'] = date('m/d/Y', $end);
        }

        $output = \Aff_Helper::callSasApi($action, $param);
        if (!$output) {
            return;
        }

        $datas = simplexml_load_string($output);
        if ($datas) {
            DB::table('shareasale_affiliatetimespan')->truncate();
            foreach ($datas as $data) {
                $ats = new \App\Models\AffiliateTimeSpan();
                $ats->affiliate = $data->affiliate;
                $ats->clicks = $data->clicks;
                $ats->gross_sales = preg_replace('/[^0-9.]+/', '', $data->grosssales);
                $ats->voids = $data->voids;
                $ats->net_sales = preg_replace('/[^0-9.]+/', '', $data->netsales);
                $ats->number_of_sales = $data->numberofsales;
                $ats->manual_credits = $data->manualcredits;
                $ats->commissions = preg_replace('/[^0-9.]+/', '', $data->commissions);
                $ats->conversion = $data->conversion;
                $ats->epc = preg_replace('/[^0-9.]+/', '', $data->epc);
                $ats->average_order = preg_replace('/[^0-9.]+/', '', $data->averageorder);
                $ats->affiliate_id = $data->affiliateid;
                $ats->organization = $data->organization;
                $ats->website = $data->website;
                $ats->numb_sales = $data->numbsales;
                $ats->numb_leads = $data->numbleads;
                $ats->numb_two_tier = $data->numbtwotier;
                $ats->numb_bonuses = $data->numbbonuses;
                $ats->numb_pay_per_call = $data->numbpaypercall;
                $ats->numb_leapfrog = $data->numbleapfrog;
                $ats->sale_commissions = preg_replace('/[^0-9.]+/', '', $data->salecommissions);
                $ats->lead_commissions = preg_replace('/[^0-9.]+/', '', $data->leadcommissions);
                $ats->two_tier_commissions = preg_replace('/[^0-9.]+/', '', $data->twotiercommissions);
                $ats->bonus_commissions = preg_replace('/[^0-9.]+/', '', $data->bonuscommissions);
                $ats->pay_per_call_commissions = preg_replace('/[^0-9.]+/', '', $data->paypercallcommissions);
                $ats->leapfrog_commissions = preg_replace('/[^0-9.]+/', '', $data->leapfrogcommissions);
                $ats->transaction_fees = preg_replace('/[^0-9.]+/', '', $data->transactionfees);
                $ats->save();
            }
        }
    }
}
