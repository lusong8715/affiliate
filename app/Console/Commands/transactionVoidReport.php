<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class transactionVoidReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:transactionvoidreport {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Transaction Void Report';

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
        $action = 'transactionvoidreport';
        $param = array();
        if ($this->option('start')) {
            $start = strtotime($this->option('start'));
            $param['datestart'] = date('m/d/Y', $start);
        } else {
            $param['datestart'] = date('m/d/Y', strtotime('-7 day'));
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
            foreach ($datas as $data) {
                $tvr = \App\Models\TransactionVoidReport::where('trans_id', '=', $data->transid)->get();
                if (!count($tvr)) {
                    $tvr = new \App\Models\TransactionVoidReport();
                    $tvr->trans_id = $data->transid;
                }
                $tvr->trans_date = date('Y-m-d', strtotime($data->transdate));
                $tvr->void_trans_id = $data->voidtransid;
                $tvr->void_date = $data->voiddate;
                $tvr->voided = $data->voided;
                $tvr->pending = $data->pending;
                $tvr->locked = $data->locked;
                $tvr->paid_currency = $data->paidcurrency;
                $tvr->user_id = $data->userid;
                $tvr->organization = $data->organization;
                $tvr->website = $data->website;
                $tvr->trans_amount = $data->transamount;
                $tvr->commission = $data->commission;
                $tvr->last_ip = $data->lastip;
                $tvr->last_port = $data->lastport;
                $tvr->last_referer = $data->lastreferer;
                $tvr->u_banner_numb = $data->ubannernumb;
                $tvr->u_banner_page = $data->ubannerpage;
                $tvr->comment = $data->comment;
                $tvr->void_reason = $data->voidreason;
                $tvr->save();
            }
        }
    }
}
