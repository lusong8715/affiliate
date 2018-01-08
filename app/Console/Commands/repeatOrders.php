<?php

namespace App\Console\Commands;

use App\Models\RepeatOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class repeatOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repeat:order {--start=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repeat Order';

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
        $start = date('m/d/Y', strtotime('-7 day'));
        if ($this->option('start')) {
            $start = $this->option('start');
        }
        $rows = DB::select("
         select order_id, count(*) as cnt from (
            (select order_number as order_id from shareasale_transactiondetail where order_number != '' and trans_date > ?)
            union all
            (select order_id from cj_commissions where order_id != '' and posting_date > ?)
            union all
            (select order_reference as order_id from webgains_transaction where order_reference != '' and date > ?)
         ) as ids 
         group by order_id having cnt > 1;", [$start, $start, $start]
        );

        foreach ($rows as $row) {
            $ro = RepeatOrder::find($row->order_id);
            if (!$ro) {
                $ro = new RepeatOrder();
                $ro->id = $row->order_id;
                $ro->save();
            }
        }
    }
}
