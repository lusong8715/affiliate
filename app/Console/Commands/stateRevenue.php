<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class stateRevenue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:staterevenue {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale State Revenue';

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
        $action = 'staterevenue';
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
            DB::table('shareasale_staterevenue')->truncate();
            foreach ($datas as $data) {
                $sr = new \App\Models\StateRevenue();
                $sr->state = $data->state;
                $sr->sales = preg_replace('/[^0-9.]+/', '', $data->sales);
                $sr->commissions = preg_replace('/[^0-9.]+/', '', $data->commissions);
                $sr->transactionfees = preg_replace('/[^0-9.]+/', '', $data->transactionfees);
                $sr->save();
            }
        }
    }
}
