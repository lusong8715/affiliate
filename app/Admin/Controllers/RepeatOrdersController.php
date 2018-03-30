<?php

namespace App\Admin\Controllers;


use App\Models\RepeatOrder;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\DB;

class RepeatOrdersController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Repeat Orders');
            $content->description('list');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Repeat Orders');
            $content->description('edit');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(RepeatOrder::class, function (Grid $grid) {

            $grid->model()->select(DB::raw('ro.*, std.trans_id as sas_trans_id, std.trans_date as sas_trans_date, std.trans_amount as sas_trans_amount, cc.commission_id as cj_commission_id, cc.posting_date as cj_posting_date, cc.sale_amount as cj_sale_amount, wt.id as wg_trans_id, wt.date as wg_trans_date, wt.value as wg_trans_amount'));
            $grid->model()->from('repeat_orders as ro');
            $grid->model()->leftJoin('shareasale_transactiondetail as std', 'ro.order_num', '=', 'std.order_number');
            $grid->model()->leftJoin('cj_commissions as cc', 'ro.order_num', '=', 'cc.order_id');
            $grid->model()->leftJoin('webgains_transaction as wt', 'ro.order_num', '=', 'wt.order_reference');
            $grid->model()->where('ro.status', '=', '0');
            $grid->model()->orderBy('ro.id', 'desc');

            $grid->id('ID')->sortable();
            $grid->order_num('Order ID')->sortable();
            $grid->sas_trans_id()->sortable();
            $grid->sas_trans_date()->sortable();
            $grid->sas_trans_amount()->sortable();
            $grid->cj_commission_id()->sortable();
            $grid->cj_posting_date()->sortable();
            $grid->cj_sale_amount()->sortable();
            $grid->wg_trans_id()->sortable();
            $grid->wg_trans_date()->sortable();
            $grid->wg_trans_amount()->sortable();
            $grid->status()->sortable()->editable('select', [1 => '已处理', 0 => '未处理']);

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
                $elem = '<div class="loading"><div class="loader"></div></div><a id="update_data" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> 更新</a>';
                $tools->append($elem);
            });

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('order_num');
                $filter->is('sas_trans_id');
                $filter->between('sas_trans_date')->datetime();
                $filter->between('sas_trans_amount');
                $filter->is('cj_commission_id');
                $filter->between('cj_posting_date')->datetime();
                $filter->between('cj_sale_amount');
                $filter->is('wg_trans_id');
                $filter->between('wg_trans_date')->datetime();
                $filter->between('wg_trans_amount');
            });

            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->disableActions();

            $grid->perPages([50, 100, 200]);
            $grid->paginate(50);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(RepeatOrder::class, function (Form $form) {

            $form->text('status');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
