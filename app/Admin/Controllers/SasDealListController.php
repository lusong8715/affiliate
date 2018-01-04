<?php

namespace App\Admin\Controllers;


use App\Models\DealList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasDealListController extends Controller
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

            $content->header('ShareASale Deal List');
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

            $content->header('ShareASale Deal List');
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
        return Admin::grid(DealList::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('end_date', 'desc');

            $grid->deal_id()->sortable();
            $grid->title()->sortable();
            $grid->start_date()->sortable();
            $grid->end_date()->sortable();
            $grid->description()->sortable();
            $grid->is_public()->display(function ($isPublic) {
                return $isPublic ? 'Yes' : 'No';
            });
            $grid->category()->sortable();
            $grid->coupon_code()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('deal_id');
                $filter->like('title');
                $filter->between('start_date')->datetime();
                $filter->between('end_date')->datetime();
                $filter->like('description');
                $filter->between('publish_date')->datetime();
                $filter->between('modified_date')->datetime();
                $filter->like('landing_page');
                $filter->like('restrictions');
                $filter->like('keywords');
                $filter->is('is_public')->select([0 => 'No', 1 => 'Yes']);
                $filter->is('category');
                $filter->is('coupon_code');
                $filter->between('custom_commission');
                $filter->like('thumbnail');
                $filter->like('big_image');
                $filter->is('store_id');
                $filter->is('store');
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
        return Admin::form(DealList::class, function (Form $form) {

            $form->display('deal_id');
            $form->display('title');
            $form->display('start_date');
            $form->display('end_date');
            $form->display('description');
            $form->display('publish_date');
            $form->display('modified_date');
            $form->display('landing_page');
            $form->display('restrictions');
            $form->display('keywords');
            $form->display('is_public');
            $form->display('category');
            $form->display('coupon_code');
            $form->display('custom_commission');
            $form->display('thumbnail');
            $form->display('big_image');
            $form->display('store_id');
            $form->display('store');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
