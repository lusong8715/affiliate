<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ledger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:ledger {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Ledger';

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
        $action = 'ledger';
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
            DB::table('shareasale_ledger')->truncate();
            foreach ($datas as $data) {
                $ledger = new \App\Models\Ledger();
                $ledger->ledger_id = $data->ledgerid;
                $ledger->action = $data->action;
                $ledger->dt = date('Y-m-d', strtotime($data->dt));
                $ledger->trans_type = $data->transtype;
                $ledger->trans_id = $data->transid;
                $ledger->deposit = $data->deposit;
                $ledger->commission = $data->commission;
                $ledger->shareasale_amount = $data->shareasaleamount;
                $ledger->impact = $data->impact;
                $ledger->comment = $data->comment;
                $ledger->save();
            }
        }
    }
}
