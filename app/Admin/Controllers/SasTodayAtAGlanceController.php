<?php

namespace App\Admin\Controllers;


use App\Models\TodayAtAGlance;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasTodayAtAGlanceController extends Controller
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

            $content->header('ShareASale Today At A Glance');
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

            $content->header('ShareASale Today At A Glance');
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
        return Admin::grid(TodayAtAGlance::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('number_of_sales', 'desc');

            $grid->affiliate()->sortable();
            $grid->clicks()->sortable();
            $grid->gross_sales()->sortable();
            $grid->net_sales()->sortable();
            $grid->number_of_sales()->sortable();
            $grid->commissions()->sortable();
            $grid->conversion()->sortable();
            $grid->epc()->sortable();
            $grid->average_order()->sortable();
            $grid->sale_commissions()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('affiliate');
                $filter->between('clicks');
                $filter->between('gross_sales');
                $filter->between('voids');
                $filter->between('net_sales');
                $filter->between('number_of_sales');
                $filter->between('manual_credits');
                $filter->between('commissions');
                $filter->between('conversion');
                $filter->between('epc');
                $filter->between('average_order');
                $filter->between('numb_sales');
                $filter->between('numb_leads');
                $filter->between('numb_two_tier');
                $filter->between('numb_bonuses');
                $filter->between('numb_pay_per_call');
                $filter->between('numb_leapfrog');
                $filter->between('sale_commissions');
                $filter->between('lead_commissions');
                $filter->between('two_tier_commissions');
                $filter->between('bonus_commissions');
                $filter->between('pay_per_call_commissions');
                $filter->between('leapfrog_commissions');
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
        return Admin::form(TodayAtAGlance::class, function (Form $form) {

            $form->display('affiliate');
            $form->display('clicks');
            $form->display('gross_sales');
            $form->display('voids');
            $form->display('net_sales');
            $form->display('number_of_sales');
            $form->display('manual_credits');
            $form->display('commissions');
            $form->display('conversion');
            $form->display('epc');
            $form->display('average_order');
            $form->display('numb_sales');
            $form->display('numb_leads');
            $form->display('numb_two_tier');
            $form->display('numb_bonuses');
            $form->display('numb_pay_per_call');
            $form->display('numb_leapfrog');
            $form->display('sale_commissions');
            $form->display('lead_commissions');
            $form->display('two_tier_commissions');
            $form->display('bonus_commissions');
            $form->display('pay_per_call_commissions');
            $form->display('leapfrog_commissions');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
