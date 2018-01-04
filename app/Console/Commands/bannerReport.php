<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class bannerReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:bannerreport {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Banner Report';

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
        $action = 'bannerreport';
        $param = array();
        if ($this->option('start')) {
            $start = strtotime($this->option('start'));
            $param['datestart'] = date('m/d/Y', $start);
        } else {
            $param['datestart'] = date('m/d/Y', strtotime('-90 day'));
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
            DB::table('shareasale_bannerreport')->truncate();
            foreach ($datas as $data) {
                $br = new \App\Models\BannerReport();
                $br->banner_id = $data->bannerid;
                $br->banner_type = $data->bannertype;
                $br->product_name = $data->productname;
                $br->unique_hits = $data->uniquehits;
                $br->commissions = preg_replace('/[^0-9.]+/', '', $data->commissions);
                $br->net_sales = preg_replace('/[^0-9.]+/', '', $data->netsales);
                $br->number_of_voids = $data->numberofvoids;
                $br->number_of_sales = $data->numberofsales;
                $br->banner_url = $data->bannerurl;
                $br->save();
            }
        }
    }
}
