<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->post('/sync', 'SyncController@index');
    $router->resource('sasconfig', 'SasConfigController');
    $router->resource('sasrefundsorder', 'SasRefundsOrderController');
    $router->resource('sasweeklyprogress', 'SasWeeklyProgressController');
    $router->resource('sastransactiondetail', 'SasTransactionDetailController');
    $router->resource('sasaffiliatetimespan', 'SasAffiliateTimeSpanController');
    $router->resource('sasactivitysummary', 'SasActivitySummaryController');
    $router->resource('sastodayataglance', 'SasTodayAtAGlanceController');
    $router->resource('sasstaterevenue', 'SasStateRevenueController');
    $router->resource('sasreportaffiliate', 'SasReportAffiliateController');
    $router->resource('sastransactioneditreport', 'SasTransactionEditReportController');
    $router->resource('sastransactionvoidreport', 'SasTransactionVoidReportController');
    $router->resource('sasledger', 'SasLedgerController');
    $router->resource('sasbannerreport', 'SasBannerReportController');
    $router->resource('sasbannerlist', 'SasBannerListController');
    $router->resource('sasdeallist', 'SasDealListController');
});
