<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class dealList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:deallist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Deal List';

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
        $action = 'dealList';
        $output = \Aff_Helper::callSasApi($action);
        if (!$output) {
            return;
        }
        $datas = simplexml_load_string($output);
        if ($datas) {
            DB::table('shareasale_deallist')->truncate();
            foreach ($datas as $data) {
                $dl = new \App\Models\DealList();
                $dl->deal_id = $data->dealid;
                $dl->title = $data->title;
                $dl->start_date = $data->startdate;
                $dl->end_date = $data->enddate;
                $dl->description = $data->description;
                $dl->publish_date = $data->publishdate;
                $dl->modified_date = $data->modifieddate;
                $dl->landing_page = $data->landingpage;
                $dl->restrictions = $data->restrictions;
                $dl->keywords = $data->keywords;
                $dl->is_public = $data->ispublic;
                $dl->category = $data->category;
                $dl->coupon_code = $data->couponcode;
                $dl->custom_commission = $data->customcommission;
                $dl->thumbnail = $data->thumbnail;
                $dl->big_image = $data->bigimage;
                $dl->store_id = $data->storeid;
                $dl->store = $data->store;
                $dl->save();
            }
        }
    }
}
