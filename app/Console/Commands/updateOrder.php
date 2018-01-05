<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class updateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Order';

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
        $file = env('ORDER_FILE');
        $content = file_get_contents($file);
        $datas = explode('|', $content);
        foreach ($datas as $line) {
            if (strpos($line, ',') === false) {
                continue;
            }
            $data = explode(',', $line);
            $order = Order::where('order_id', '=', $data[0])->get();
            if (count($order)) {
                continue;
            }
            $order = new Order();
            $order->order_id = $data[0];
            $order->status = $data[1];
            $order->currency = $data[2];
            $order->amount = $data[3];
            $order->refund_date = $data[4];
            $order->save();
        }
    }
}
