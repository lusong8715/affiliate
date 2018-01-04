<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class activitySummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:activitysummary {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Activity Summary';

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
        $action = 'activitysummary';
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
            DB::table('shareasale_activitysummary')->truncate();
            foreach ($datas as $data) {
                $as = new \App\Models\ActivitySummary();
                $as->userid = $data->userid;
                $as->sales = $data->sales;
                $as->gross_sales = $data->grosssales;
                $as->commissions = $data->commissions;
                $as->max_sale = $data->maxsale;
                $as->min_sale = $data->minsale;
                $as->avg_commission = $data->avgcommission;
                $as->net_sales = $data->netsales;
                $as->voids = $data->voids;
                $as->save();
            }
        }
    }
}
