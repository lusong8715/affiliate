<?php

namespace App\Admin\Controllers;


use App\Models\Commissions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CjCommissionsController extends Controller
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

            $content->header('CJ Commissions');
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

            $content->header('CJ Commissions');
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
        return Admin::grid(Commissions::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('event_date', 'desc');

            $grid->order_id()->sortable();
            $grid->commission_id()->sortable();
            $grid->posting_date()->sortable();
            $grid->event_date()->sortable();
            $grid->publisher_name();
            $grid->sale_amount()->sortable();
            $grid->commission_amount()->sortable();
            $grid->order_discount()->sortable();
            $grid->locking_date()->sortable();
            $grid->country();
            $grid->action_status();

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
                $filter->is('action_status');
                $filter->is('action_type');
                $filter->is('aid');
                $filter->is('commission_id');
                $filter->is('country');
                $filter->between('event_date')->datetime();
                $filter->between('locking_date')->datetime();
                $filter->is('order_id');
                $filter->is('original')->select([1 => 'Yes', 0 => 'No']);
                $filter->is('original_action_id');
                $filter->between('posting_date')->datetime();
                $filter->is('website_id');
                $filter->is('action_tracker_id');
                $filter->like('action_tracker_name');
                $filter->is('cid');
                $filter->like('publisher_name');
                $filter->between('commission_amount');
                $filter->between('order_discount');
                $filter->between('sale_amount');
                $filter->is('is_cross_device')->select([1 => 'Yes', 0 => 'No']);
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
        return Admin::form(Commissions::class, function (Form $form) {

            $form->display('action_status');
            $form->display('action_type');
            $form->display('aid');
            $form->display('commission_id');
            $form->display('country');
            $form->display('event_date');
            $form->display('locking_date');
            $form->display('order_id');
            $form->display('original');
            $form->display('original_action_id');
            $form->display('posting_date');
            $form->display('website_id');
            $form->display('action_tracker_id');
            $form->display('action_tracker_name');
            $form->display('cid');
            $form->display('publisher_name');
            $form->display('commission_amount');
            $form->display('order_discount');
            $form->display('sale_amount');
            $form->display('is_cross_device');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
