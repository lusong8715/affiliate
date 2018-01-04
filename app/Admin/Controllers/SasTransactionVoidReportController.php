<?php

namespace App\Admin\Controllers;


use App\Models\TransactionVoidReport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasTransactionVoidReportController extends Controller
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

            $content->header('ShareASale Transaction Void Report');
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

            $content->header('ShareASale Transaction Void Report');
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
        return Admin::grid(TransactionVoidReport::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('void_date', 'desc');

            $grid->trans_id()->sortable();
            $grid->trans_date()->sortable();
            $grid->void_trans_id()->sortable();
            $grid->void_date()->sortable();
            $grid->paid_currency()->sortable();
            $grid->user_id()->sortable();
            $grid->trans_amount()->sortable();
            $grid->commission()->sortable();
            $grid->last_ip()->sortable();
            $grid->void_reason();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('trans_id');
                $filter->between('trans_date')->datetime();
                $filter->is('void_trans_id');
                $filter->between('void_date')->datetime();
                $filter->is('voided');
                $filter->is('pending');
                $filter->is('locked');
                $filter->is('paid_currency');
                $filter->is('user_id');
                $filter->is('organization');
                $filter->like('website');
                $filter->between('trans_amount');
                $filter->between('commission');
                $filter->is('last_ip');
                $filter->is('last_port');
                $filter->like('last_referer');
                $filter->is('u_banner_numb');
                $filter->like('u_banner_page');
                $filter->like('comment');
                $filter->is('void_reason');
            });

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
        return Admin::form(TransactionVoidReport::class, function (Form $form) {

            $form->display('trans_id');
            $form->display('trans_date')->datetime();
            $form->display('void_trans_id');
            $form->display('void_date')->datetime();
            $form->display('voided');
            $form->display('pending');
            $form->display('locked');
            $form->display('paid_currency');
            $form->display('user_id');
            $form->display('organization');
            $form->display('website');
            $form->display('trans_amount');
            $form->display('commission');
            $form->display('last_ip');
            $form->display('last_port');
            $form->display('last_referer');
            $form->display('u_banner_numb');
            $form->display('u_banner_page');
            $form->display('comment');
            $form->display('void_reason');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
