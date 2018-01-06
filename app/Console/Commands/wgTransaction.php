<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class wgTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wg:transaction {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Webgains Transaction Detail';

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
        $types = array('us', 'ca', 'uk', 'au');
        $start = date('Y-m-d', strtotime('-3 day'));
        if ($this->option('start')) {
            $start = $this->option('start');
        }
        $end = date('Y-m-d');
        if ($this->option('end')) {
            $end = $this->option('end');
        }
        foreach ($types as $type) {
            $datas = \Aff_Helper::callWgApi($type, $start, $end);
            if (!$datas) {
                continue;
            }

            foreach ($datas as $data) {
                $wt = \App\Models\WebgainsTransaction::find($data['id']);
                if (!$wt) {
                    $wt = new \App\Models\WebgainsTransaction();
                    $wt->id = $data['id'];
                }
                $wt->date = $data['date'];
                $wt->campaign_id = $data['campaign_id'];
                $wt->event_id = $data['event_id'];
                $wt->customer_id = $data['customer_id'];
                $wt->order_reference = $data['order_reference'];
                $wt->voucher_code = $data['voucher_code'];
                $wt->value = $data['value'];
                $wt->commission = $data['commission'];
                $wt->currency = $data['currency'];
                $wt->status = $data['status'];
                $wt->comment = $data['comment'];
                $wt->type = $type;
                $wt->save();
            }
        }
    }
}
