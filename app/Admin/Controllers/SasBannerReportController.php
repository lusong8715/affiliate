<?php

namespace App\Admin\Controllers;


use App\Models\BannerReport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasBannerReportController extends Controller
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

            $content->header('ShareASale Banner Report');
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

            $content->header('ShareASale Banner Report');
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
        return Admin::grid(BannerReport::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('unique_hits', 'desc');

            $grid->banner_id()->sortable();
            $grid->banner_type();
            $grid->product_name()->sortable();
            $grid->unique_hits()->sortable();
            $grid->commissions()->sortable();
            $grid->net_sales()->sortable();
            $grid->number_of_voids()->sortable();
            $grid->number_of_sales()->sortable();
            $grid->banner_url();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('banner_id');
                $filter->is('banner_type');
                $filter->like('product_name');
                $filter->between('unique_hits');
                $filter->between('commissions');
                $filter->between('net_sales');
                $filter->between('number_of_voids');
                $filter->between('number_of_sales');
                $filter->like('banner_url');
            });

            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
                $elem = '<div class="loading"><div class="loader"></div></div>Start: <input id="date_start" placeholder="yyyy/mm/dd">End: <input id="date_end" placeholder="yyyy/mm/dd"><a id="update_data" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> 更新</a>';
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
        return Admin::form(BannerReport::class, function (Form $form) {

            $form->display('banner_id');
            $form->display('banner_type');
            $form->display('product_name');
            $form->display('unique_hits');
            $form->display('commissions');
            $form->display('net_sales');
            $form->display('number_of_voids');
            $form->display('number_of_sales');
            $form->display('banner_url');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
