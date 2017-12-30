<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class stateRevenue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:staterevenue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale State Revenue Report';

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
        $file = dirname(__FILE__) . '/staterevenue.xml';
        $xml = file_get_contents($file);
        $datas = simplexml_load_string($xml);
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
