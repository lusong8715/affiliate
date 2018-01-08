<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $m = date('Y-m') . '-1';
                    $result = DB::select("select sum(trans_amount) as amount from shareasale_transactiondetail where trans_date > ?", [$m]);
                    $sasAmount = $result[0]->amount;
                    $result = DB::select("select sum(sale_amount) as amount from cj_commissions where posting_date > ?", [$m]);
                    $cjAmount = $result[0]->amount;
                    $result = DB::select("select sum(value) as amount from webgains_transaction where date > ?", [$m]);
                    $wgAmount = $result[0]->amount;
                    $doughnut = new Doughnut([
                        ['ShareASale', $sasAmount],
                        ['CJ', $cjAmount],
                        ['Webgains', $wgAmount],
                    ]);
                    $column->append((new Box('Amount of the month', $doughnut))->removable()->collapsable()->style('info'));
                });

                $row->column(6, function (Column $column) {

                    $collapse = new Collapse();
                    $dates = array();
                    $months = array();
                    $y = date('Y');
                    $m = date('m');
                    $cnt = 6;
                    while ($cnt > 0) {
                        $m--;
                        if ($m == 0) {
                            $m = 12;
                            $y--;
                        }
                        $months[] = $m;
                        $dates[] = $y . '-' . $m;
                        $cnt--;
                    }
                    $months = array_reverse($months);
                    $dates = array_reverse($dates);
                    $startDate = $dates[0] . '-1';
                    $endDate = $y . $m . '-1';
                    $result = DB::select("select month(trans_date) as mon, sum(trans_amount) as amount from shareasale_transactiondetail where trans_date >= ? and trans_date < ? group by mon", [$startDate, $endDate]);
                    $sasDatas = $this->_getAmountForMonth($months, $result);
                    $result = DB::select("select month(posting_date) as mon, sum(sale_amount) as amount from cj_commissions where posting_date >= ? and posting_date < ? group by mon", [$startDate, $endDate]);
                    $cjDatas = $this->_getAmountForMonth($months, $result);
                    $result = DB::select("select month(date) as mon, sum(value) as amount from webgains_transaction where date >= ? and date < ? group by mon", [$startDate, $endDate]);
                    $wgDatas = $this->_getAmountForMonth($months, $result);
                    $bar = new Bar(
                        $months,
                        [
                            ['ShareASale', $sasDatas],
                            ['CJ', $cjDatas],
                            ['Webgains', $wgDatas],
                        ]
                    );
                    $collapse->add('Amount past 6 months', $bar);
                    $column->append($collapse);
                });

            });

            $headers = ['Order Id', 'Trans Id', 'Trans Date', 'Amount', 'Code', 'Type'];
            $rows = $rows = DB::select("
                select order_number as order_id, trans_id, trans_date, trans_amount as amount, coupon_code as code, 'ShareASale' as type from shareasale_transactiondetail
                union
                select order_id, commission_id as trans_id, posting_date as trans_date, sale_amount as amount, '' as code, 'CJ' as type from cj_commissions
                union
                select order_reference as order_id, id as trans_id, date as trans_date, value as amount, voucher_code as code, 'Webgains' as type from webgains_transaction
                order by trans_date desc limit 30;
            ");

            $content->row((new Box('Newest 30 order', new Table($headers, $rows)))->style('info')->solid());
        });
    }

    private function _getAmountForMonth($months, $datas) {
        $result = array();
        $arr = array();
        foreach ($datas as $data) {
            $arr[$data->mon] = $data->amount;
        }
        foreach ($months as $month) {
            if (isset($arr[$month])) {
                $result[] = $arr[$month];
            } else {
                $result[] = 0;
            }
        }
        return $result;
    }
}