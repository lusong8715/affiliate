<?php

namespace App\Admin\Controllers;


use App\Models\TransactionEditReport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasTransactionEditReportController extends Controller
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

            $content->header('ShareASale Transaction Edit Report');
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

            $content->header('ShareASale Transaction Edit Report');
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
        return Admin::grid(TransactionEditReport::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('edit_date', 'desc');

            $grid->trans_id()->sortable();
            $grid->trans_date()->sortable();
            $grid->edit_trans_id()->sortable();
            $grid->edit_date()->sortable();
            $grid->paid_currency()->sortable();
            $grid->user_id()->sortable();
            $grid->trans_amount()->sortable();
            $grid->original_trans_amount()->sortable();
            $grid->new_trans_amount()->sortable();
            $grid->commission()->sortable();
            $grid->original_commission()->sortable();
            $grid->new_commission()->sortable();
            $grid->last_ip()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('trans_id');
                $filter->between('trans_date')->datetime();
                $filter->is('edit_trans_id');
                $filter->between('edit_date')->datetime();
                $filter->is('voided');
                $filter->is('pending');
                $filter->is('locked');
                $filter->is('paid_currency');
                $filter->is('user_id');
                $filter->is('organization');
                $filter->like('website');
                $filter->between('trans_amount');
                $filter->between('original_trans_amount');
                $filter->between('new_trans_amount');
                $filter->between('commission');
                $filter->between('original_commission');
                $filter->between('new_commission');
                $filter->is('last_ip');
                $filter->is('last_port');
                $filter->like('last_referer');
                $filter->is('u_banner_numb');
                $filter->like('u_banner_page');
                $filter->like('comment');
                $filter->like('original_comment');
                $filter->like('new_comment');
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
        return Admin::form(TransactionEditReport::class, function (Form $form) {

            $form->display('trans_id');
            $form->display('trans_date')->datetime();
            $form->display('edit_trans_id');
            $form->display('edit_date')->datetime();
            $form->display('voided');
            $form->display('pending');
            $form->display('locked');
            $form->display('paid_currency');
            $form->display('user_id');
            $form->display('organization');
            $form->display('website');
            $form->display('trans_amount');
            $form->display('original_trans_amount');
            $form->display('new_trans_amount');
            $form->display('commission');
            $form->display('original_commission');
            $form->display('new_commission');
            $form->display('last_ip');
            $form->display('last_port');
            $form->display('last_referer');
            $form->display('u_banner_numb');
            $form->display('u_banner_page');
            $form->display('comment');
            $form->display('original_comment');
            $form->display('new_comment');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
