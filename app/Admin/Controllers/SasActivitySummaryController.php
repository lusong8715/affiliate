<?php

namespace App\Admin\Controllers;


use App\Models\ActivitySummary;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasActivitySummaryController extends Controller
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

            $content->header('ShareASale Activity Summary');
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

            $content->header('ShareASale Activity Summary');
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
        return Admin::grid(ActivitySummary::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('sales', 'desc');

            $grid->id()->sortable();
            $grid->userid()->sortable();
            $grid->sales()->sortable();
            $grid->gross_sales()->sortable();
            $grid->commissions()->sortable();
            $grid->max_sale()->sortable();
            $grid->min_sale()->sortable();
            $grid->avg_commission()->sortable();
            $grid->net_sales()->sortable();
            $grid->voids()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('userid');
                $filter->between('sales');
                $filter->between('gross_sales');
                $filter->between('commissions');
                $filter->between('max_sale');
                $filter->between('min_sale');
                $filter->between('avg_commission');
                $filter->between('net_sales');
                $filter->between('voids');
            });

            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
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
        return Admin::form(ActivitySummary::class, function (Form $form) {

            $form->display('userid');
            $form->display('sales');
            $form->display('gross_sales');
            $form->display('commissions');
            $form->display('max_sale');
            $form->display('min_sale');
            $form->display('avg_commission');
            $form->display('net_sales');
            $form->display('voids');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
