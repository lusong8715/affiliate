<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class activitySummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:activitySummary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Activity Summary Report';

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
        $file = dirname(__FILE__) . '/activitysummary.xml';
        $xml = file_get_contents($file);
        $datas = simplexml_load_string($xml);
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
