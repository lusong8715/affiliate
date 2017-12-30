<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('sasconfig', 'SasConfigController');
    $router->resource('sasrefundsorder', 'SasRefundsOrderController');
    $router->resource('sasweeklyprogress', 'SasWeeklyProgressController');
    $router->resource('sastransactiondetail', 'SasTransactionDetailController');
    $router->resource('sasaffiliatetimespan', 'SasAffiliateTimeSpanController');
    $router->resource('sasactivitysummary', 'SasActivitySummaryController');
    $router->resource('sastodayataglance', 'SasTodayAtAGlanceController');
    $router->resource('staterevenue', 'SasStateRevenueController');
});
