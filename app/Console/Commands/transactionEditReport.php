<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class transactionEditReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:transactioneditreport {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Transaction Edit Report';

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
        $action = 'transactioneditreport';
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
                $ter = \App\Models\TransactionEditReport::where('trans_id', '=', $data->transid)->get();
                if (!count($ter)) {
                    $ter = new \App\Models\TransactionEditReport();
                    $ter->trans_id = $data->transid;
                } else {
                    $ter = $ter[0];
                }
                $ter->trans_date = date('Y-m-d', strtotime($data->transdate));
                $ter->edit_trans_id = $data->edittransid;
                $ter->edit_date = $data->editdate;
                $ter->voided = $data->voided;
                $ter->pending = $data->pending;
                $ter->locked = $data->locked;
                $ter->paid_currency = $data->paidcurrency;
                $ter->user_id = $data->userid;
                $ter->organization = $data->organization;
                $ter->website = $data->website;
                $ter->trans_amount = $data->transamount;
                $ter->original_trans_amount = $data->originaltransamount;
                $ter->new_trans_amount = $data->newtransamount;
                $ter->commission = $data->commission;
                $ter->original_commission = $data->originalcommission;
                $ter->new_commission = $data->newcommission;
                $ter->last_ip = $data->lastip;
                $ter->last_port = $data->lastport;
                $ter->last_referer = $data->lastreferer;
                $ter->u_banner_numb = $data->ubannernumb;
                $ter->u_banner_page = $data->ubannerpage;
                $ter->comment = $data->comment;
                $ter->original_comment = $data->originalcomment;
                $ter->new_comment = $data->newcomment;
                $ter->save();
            }
        }
    }
}
