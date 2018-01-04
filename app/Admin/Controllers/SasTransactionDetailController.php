<?php

namespace App\Admin\Controllers;


use App\Models\TransactionDetail;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasTransactionDetailController extends Controller
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

            $content->header('ShareASale Transaction Detail');
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

            $content->header('ShareASale Transaction Detail');
            $content->description('detail');

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
        return Admin::grid(TransactionDetail::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('trans_id', 'desc');

            $grid->trans_id()->sortable();
            $grid->user_id()->sortable();
            $grid->trans_date()->sortable();
            $grid->trans_amount()->sortable();
            $grid->commission()->sortable();
            $grid->ssamount()->sortable();
            $grid->comment();
            $grid->last_ip();
            $grid->last_referer();
            $grid->banner_number()->sortable();
            $grid->date_of_trans()->sortable();
            $grid->date_of_click()->sortable();
            $grid->time_of_click();
            $grid->lock_date()->sortable();
            $grid->order_number()->sortable();
            $grid->coupon_code()->sortable();

            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
                $elem = '<div class="loading"><div class="loader"></div></div><a id="update_data" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> 更新</a>';
                $tools->append($elem);
            });

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('trans_id');
                $filter->is('user_id');
                $filter->between('trans_date')->datetime();
                $filter->between('trans_amount');
                $filter->between('commission');
                $filter->between('ssamount');
                $filter->like('comment');
                $filter->is('voided');
                $filter->is('locked');
                $filter->is('pending');
                $filter->is('last_ip');
                $filter->is('last_referer');
                $filter->is('banner_number');
                $filter->like('banner_page');
                $filter->between('date_of_trans')->datetime();
                $filter->between('date_of_click')->datetime();
                $filter->between('date_of_reversal')->datetime();
                $filter->like('time_of_click');
                $filter->between('return_days');
                $filter->is('tool_id');
                $filter->is('store_id');
                $filter->between('lock_date')->datetime();
                $filter->is('transaction_type');
                $filter->is('commission_type');
                $filter->like('sku_list');
                $filter->like('price_list');
                $filter->like('quantity_list');
                $filter->is('order_number');
                $filter->is('parent_trans');
                $filter->is('banner_name');
                $filter->is('banner_type');
                $filter->is('coupon_code');
                $filter->is('reference_trans');
                $filter->is('new_customer_flag')->select([1 => 'Yes', 0 => 'No']);
                $filter->like('useragent');
                $filter->is('original_currency');
                $filter->between('original_currency_amount');
                $filter->is('is_mobile')->select([1 => 'Yes', 0 => 'No']);
                $filter->is('used_a_coupon')->select([1 => 'Yes', 0 => 'No']);
                $filter->is('merchant_defined_type');
            });

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
        return Admin::form(TransactionDetail::class, function (Form $form) {

            $form->display('trans_id');
            $form->display('user_id');
            $form->display('trans_date');
            $form->display('trans_amount');
            $form->display('commission');
            $form->display('ssamount');
            $form->display('comment');
            $form->display('voided');
            $form->display('locked');
            $form->display('pending');
            $form->display('last_ip');
            $form->display('last_referer');
            $form->display('banner_number');
            $form->display('banner_page');
            $form->display('date_of_trans');
            $form->display('date_of_click');
            $form->display('time_of_click');
            $form->display('date_of_reversal');
            $form->display('return_days');
            $form->display('tool_id');
            $form->display('store_id');
            $form->display('lock_date');
            $form->display('transaction_type');
            $form->display('commission_type');
            $form->display('sku_list');
            $form->display('price_list');
            $form->display('quantity_list');
            $form->display('order_number');
            $form->display('parent_trans');
            $form->display('banner_name');
            $form->display('banner_type');
            $form->display('coupon_code');
            $form->display('reference_trans');
            $form->display('new_customer_flag');
            $form->display('useragent');
            $form->display('original_currency');
            $form->display('original_currency_amount');
            $form->display('is_mobile');
            $form->display('used_a_coupon');
            $form->display('merchant_defined_type');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
