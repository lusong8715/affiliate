<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SyncController extends Controller
{
    public function index()
    {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $action = $_POST['action'];
        $param = array();
        if ($start) {
            $param['--start'] = $start;
        }
        if ($end) {
            $param['--end'] = $end;
        }
        switch ($action) {
            case 'sasweeklyprogress':
                Artisan::call('shareasale:weeklyprogress', $param);
                break;
            case 'sastransactiondetail':
                Artisan::call('shareasale:transactiondetail', $param);
                break;
            case 'sasaffiliatetimespan':
                Artisan::call('shareasale:affiliatetimespan', $param);
                break;
            case 'sasactivitysummary':
                Artisan::call('shareasale:activitysummary', $param);
                break;
            case 'sastodayataglance':
                Artisan::call('shareasale:todayataglance');
                break;
            case 'sasstaterevenue':
                Artisan::call('shareasale:staterevenue', $param);
                break;
            case 'sasreportaffiliate':
                Artisan::call('shareasale:reportaffiliate');
                break;
            case 'sastransactioneditreport':
                Artisan::call('shareasale:transactioneditreport', $param);
                break;
            case 'sastransactionvoidreport':
                Artisan::call('shareasale:transactionvoidreport', $param);
                break;
            case 'sasledger':
                Artisan::call('shareasale:ledger', $param);
                break;
            case 'sasbannerreport':
                Artisan::call('shareasale:bannerreport', $param);
                break;
            case 'sasbannerlist':
                Artisan::call('shareasale:bannerlist');
                break;
            case 'sasdeallist':
                Artisan::call('shareasale:deallist');
                break;
            default:
                break;
        }
        echo json_encode(['status' => 'success']);
    }
}
