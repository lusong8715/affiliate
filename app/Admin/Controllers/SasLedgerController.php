<?php

namespace App\Admin\Controllers;


use App\Models\Ledger;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasLedgerController extends Controller
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

            $content->header('ShareASale Ledger');
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

            $content->header('ShareASale Ledger');
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
        return Admin::grid(Ledger::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('dt', 'desc');
            $grid->model()->orderBy('trans_id', 'desc');

            $grid->ledger_id()->sortable();
            $grid->action()->sortable();
            $grid->dt()->sortable();
            $grid->trans_type()->sortable();
            $grid->trans_id()->sortable();
            $grid->deposit()->sortable();
            $grid->commission()->sortable();
            $grid->shareasale_amount()->sortable();
            $grid->impact()->sortable();
            $grid->comment();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('ledger_id');
                $filter->is('action');
                $filter->between('dt')->datetime();
                $filter->is('trans_type');
                $filter->is('trans_id');
                $filter->is('deposit');
                $filter->between('commission');
                $filter->between('shareasale_amount');
                $filter->between('impact');
                $filter->like('comment');
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
        return Admin::form(Ledger::class, function (Form $form) {

            $form->display('ledger_id');
            $form->display('action');
            $form->display('dt');
            $form->display('trans_type');
            $form->display('trans_id');
            $form->display('deposit');
            $form->display('commission');
            $form->display('shareasale_amount');
            $form->display('impact');
            $form->display('comment');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
