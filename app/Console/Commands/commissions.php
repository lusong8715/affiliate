<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class commissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cj:commissions {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CJ Commissions Detail';

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
        $output = \Aff_Helper::callCjApi($this->option('start'), $this->option('end'));
        if (!$output) {
            return;
        }

        $datas = simplexml_load_string($output);
        if ($datas) {
            foreach ($datas->commissions->commission as $data) {
                $data = (array)$data;
                $commissions = \App\Models\Commissions::where('commission_id', '=', $data['commission-id'])->get();
                if (!count($commissions)) {
                    $commissions = new \App\Models\Commissions();
                    $commissions->commission_id = $data['commission-id'];
                } else {
                    $commissions = $commissions[0];
                }
                $commissions->action_status = $data['action-status'];
                $commissions->action_type = $data['action-type'];
                $commissions->aid = $data['aid'];
                $commissions->country = $data['country'];
                $commissions->event_date = date('Y-m-d H:i:s', strtotime($data['event-date']));
                $commissions->locking_date = $data['locking-date'];
                $commissions->order_id = $data['order-id'];
                $commissions->original = ($data['original'] == 'true' ? 1 : 0);
                $commissions->original_action_id = $data['original-action-id'];
                $commissions->posting_date = date('Y-m-d H:i:s', strtotime($data['posting-date']));
                $commissions->website_id = $data['website-id'];
                $commissions->action_tracker_id = $data['action-tracker-id'];
                $commissions->action_tracker_name = $data['action-tracker-name'];
                $commissions->cid = $data['cid'];
                $commissions->publisher_name = $data['publisher-name'];
                $commissions->commission_amount = $data['commission-amount'];
                $commissions->order_discount = $data['order-discount'];
                $commissions->sale_amount = $data['sale-amount'];
                $commissions->is_cross_device = ($data['is-cross-device'] == 'true' ? 1 : 0);
                $commissions->save();
            }
        }
    }
}
