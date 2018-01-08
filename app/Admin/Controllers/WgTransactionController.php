<?php

namespace App\Admin\Controllers;


use App\Models\WebgainsTransaction;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class WgTransactionController extends Controller
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

            $content->header('Webgains Transaction');
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

            $content->header('Webgains Transaction');
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
        return Admin::grid(WebgainsTransaction::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('date', 'desc');

            $grid->id()->sortable();
            $grid->campaign_id()->sortable();
            $grid->date()->sortable();
            $grid->order_reference()->sortable();
            $grid->voucher_code();
            $grid->value()->sortable();
            $grid->commission()->sortable();
            $grid->currency();
            $grid->type()->sortable();

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
                $filter->between('date')->datetime();
                $filter->is('campaign_id');
                $filter->is('event_id');
                $filter->is('customer_id');
                $filter->is('order_reference');
                $filter->is('voucher_code');
                $filter->between('value');
                $filter->between('commission');
                $filter->is('currency');
                $filter->is('status');
                $filter->like('comment');
                $filter->is('type');
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
        return Admin::form(WebgainsTransaction::class, function (Form $form) {

            $form->display('id');
            $form->display('date');
            $form->display('campaign_id');
            $form->display('event_id');
            $form->display('customer_id');
            $form->display('order_reference');
            $form->display('voucher_code');
            $form->display('value');
            $form->display('commission');
            $form->display('currency');
            $form->display('status');
            $form->display('comment');
            $form->display('type');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
