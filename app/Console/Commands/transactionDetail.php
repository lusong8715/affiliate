<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class transactionDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:transactiondetail {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Transaction Detail Report';

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
        $action = 'transactiondetail';
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

        $output = str_replace('<lastreferer>', '<lastreferer><![CDATA[', $output);
        $output = str_replace('</lastreferer>', ']]></lastreferer>', $output);
        $output = str_replace('<bannername>', '<bannername><![CDATA[', $output);
        $output = str_replace('</bannername>', ']]></bannername>', $output);
        $output = str_replace('<bannerpage>', '<bannerpage><![CDATA[', $output);
        $output = str_replace('</bannerpage>', ']]></bannerpage>', $output);
        $output = str_replace('<useragent>', '<useragent><![CDATA[', $output);
        $output = str_replace('</useragent>', ']]></useragent>', $output);

        $datas = simplexml_load_string($output);
        if ($datas) {
            foreach ($datas as $data) {
                $td = \App\Models\TransactionDetail::where('trans_id', '=', $data->transid)->get();
                if (!count($td)) {
                    $td = new \App\Models\TransactionDetail();
                    $td->trans_id = $data->transid;
                } else {
                    $td = $td[0];
                }
                $td->user_id = $data->userid;
                $td->trans_date = date('Y-m-d H:i:s', strtotime($data->transdate));
                $td->trans_amount = $data->transamount;
                $td->commission = $data->commission;
                $td->ssamount = $data->ssamount;
                $td->comment = $data->comment;
                $td->voided = $data->voided;
                $td->locked = $data->locked;
                $td->pending = $data->pending;
                $td->last_ip = $data->lastip;
                $td->last_referer = $data->lastreferer;
                $td->banner_number = $data->bannernumber;
                $td->banner_page = $data->bannerpage;
                $td->date_of_trans = $data->dateoftrans;
                $td->date_of_click = $data->dateofclick;
                $td->time_of_click = $data->timeofclick;
                $td->date_of_reversal = $data->dateofreversal;
                $td->return_days = $data->returndays;
                $td->tool_id = $data->toolid;
                $td->store_id = $data->storeid;
                $td->lock_date = $data->lockdate;
                $td->transaction_type = $data->transactiontype;
                $td->commission_type = $data->commissiontype;
                $td->sku_list = $data->skulist;
                $td->price_list = $data->pricelist;
                $td->quantity_list = $data->quantitylist;
                $td->order_number = $data->ordernumber;
                $td->parent_trans = $data->parenttrans;
                $td->banner_name = $data->bannername;
                $td->banner_type = $data->bannertype;
                $td->coupon_code = $data->couponcode;
                $td->reference_trans = $data->referencetrans;
                $td->new_customer_flag = $data->newcustomerflag;
                $td->useragent = $data->useragent;
                $td->original_currency = $data->originalcurrency;
                $td->original_currency_amount = $data->originalcurrencyamount;
                $td->is_mobile = $data->ismobile;
                $td->used_a_coupon = $data->usedacoupon;
                $td->merchant_defined_type = $data->merchantdefinedtype;
                $td->save();
            }
        }
    }
}
