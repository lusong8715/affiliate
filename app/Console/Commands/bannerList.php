<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class bannerList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:bannerlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Banner List';

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
        $action = 'bannerList';
        $output = \Aff_Helper::callSasApi($action);
        if (!$output) {
            return;
        }

        $output = str_replace('<name>', '<name><![CDATA[', $output);
        $output = str_replace('</name>', ']]></name>', $output);
        $output = str_replace('<bannertext>', '<bannertext><![CDATA[', $output);
        $output = str_replace('</bannertext>', ']]></bannertext>', $output);

        $datas = simplexml_load_string($output);
        if ($datas) {
            DB::table('shareasale_bannerlist')->truncate();
            foreach ($datas as $data) {
                $bl = new \App\Models\BannerList();
                $bl->banner_id = $data->bannerid;
                $bl->display_type = $data->displaytype;
                $bl->image_url = $data->imageurl;
                $bl->landing_url = $data->landingurl;
                $bl->name = $data->name;
                $bl->banner_text = $data->bannertext;
                $bl->category = $data->category;
                $bl->is_public = $data->ispublic;
                $bl->store_id = $data->storeid;
                $bl->modified_date = $data->modifieddate;
                $bl->save();
            }
        }
    }
}
