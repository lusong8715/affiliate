<?php

namespace App\Admin\Controllers;


use App\Models\SasConfig;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasConfigController extends Controller
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

            $content->header('ShareASale Config');
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

            $content->header('ShareASale Config');
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
        return Admin::grid(SasConfig::class, function (Grid $grid) {

            $grid->id('ID');
            $grid->merchant_id();
            $grid->api_url();
            $grid->api_token();
            $grid->api_secret();
            $grid->api_version();

            $grid->disableCreation();
            $grid->disablePagination();
            $grid->disableFilter();
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SasConfig::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('merchant_id', 'Merchant Id');
            $form->text('api_url', 'Api Url')->rules('required');
            $form->text('api_token', 'Api Token')->rules('required');
            $form->text('api_secret', 'Api Secret Key')->rules('required');
            $form->display('api_version', 'Api Version');

            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });
        });
    }
}
