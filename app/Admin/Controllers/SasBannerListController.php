<?php

namespace App\Admin\Controllers;


use App\Models\BannerList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasBannerListController extends Controller
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

            $content->header('ShareASale Banner List');
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

            $content->header('ShareASale Banner List');
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
        return Admin::grid(BannerList::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('modified_date', 'desc');

            $grid->banner_id()->sortable();
            $grid->display_type()->sortable();
            $grid->image_url();
            $grid->name()->sortable();
            $grid->category()->sortable();
            $grid->is_public()->sortable()->display(function ($isPublic) {
                return $isPublic ? 'Yes' : 'No';
            });
            $grid->modified_date()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('banner_id');
                $filter->is('display_type');
                $filter->like('image_url');
                $filter->like('landing_url');
                $filter->like('name');
                $filter->like('banner_text');
                $filter->is('category');
                $filter->is('is_public')->select([0 => 'No', 1 => 'Yes']);
                $filter->is('store_id');
                $filter->between('modified_date')->datetime();
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
        return Admin::form(BannerList::class, function (Form $form) {

            $form->display('banner_id');
            $form->display('display_type');
            $form->display('image_url');
            $form->display('landing_url');
            $form->display('name');
            $form->display('banner_text');
            $form->display('category');
            $form->display('is_public');
            $form->display('store_id');
            $form->display('modified_date');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
