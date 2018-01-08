<?php

namespace App\Admin\Controllers;


use App\Models\Order;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\DB;

class SasRefundsOrderController extends Controller
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

            $content->header('ShareASale Refunds Order');
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

            $content->header('ShareASale Refunds Order');
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
        return Admin::grid(Order::class, function (Grid $grid) {
            $grid->model()->select(DB::raw('ro.*, td.trans_id, td.trans_date'));
            $grid->model()->from('refunds_order as ro');
            $grid->model()->join('shareasale_transactiondetail as td', 'ro.order_id', '=', 'td.order_number');
            $grid->model()->whereRaw('((td.original_currency = "" and td.trans_amount <> ro.amount) or (td.original_currency = ro.currency and td.original_currency_amount <> ro.amount))');
            $grid->model()->orderBy('processed', 'asc');
            $grid->model()->orderBy('trans_id', 'desc');

            $grid->trans_id()->sortable();
            $grid->trans_date()->sortable();
            $grid->order_id()->sortable();
            $grid->status()->sortable()->display(function ($status) {
                if ($status == 'return_completed') {
                    return '退货(整单)';
                } else if ($status == 'return_part_completed') {
                    return '退货(部分)';
                }
                return $status;
            });
            $grid->currency()->sortable();
            $grid->amount()->sortable();
            $grid->refund_date()->sortable();
            $grid->processed()->sortable()->editable('select', [1 => '已处理', 0 => '未处理']);

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('order_id');
                $filter->is('trans_id');
                $filter->between('trans_date')->datetime();
                $filter->is('status')->select(['return_completed' => '退货(整单)', 'return_part_completed' => '退货(部分)']);
                $filter->is('currency');
                $filter->between('amount');
                $filter->between('refund_date')->datetime();
                $filter->is('processed')->select([1 => '已处理', 0 => '未处理']);
            });

            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->disableActions();

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
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
        return Admin::form(Order::class, function (Form $form) {

            $form->text('processed');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
