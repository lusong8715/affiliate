<?php

namespace App\Admin\Controllers;


use App\Models\ReportAffiliate;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SasReportAffiliateController extends Controller
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

            $content->header('ShareASale Report Affiliate');
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

            $content->header('ShareASale Report Affiliate');
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
        return Admin::grid(ReportAffiliate::class, function (Grid $grid) {
            $grid->rows(function ($rows) {
                $rows->setAttributes(array('class' => 'open_view'));
            });
            $grid->model()->orderBy('apply_date', 'desc');

            $grid->apply_date()->sortable();
            $grid->status()->sortable();
            $grid->website()->sortable();
            $grid->commissions_total()->sortable();
            $grid->sales_total()->sortable();
            $grid->hits_total()->sortable();
            $grid->sale_commission()->sortable();
            $grid->country()->sortable();
            $grid->tags()->sortable();
            $grid->feedback_count()->sortable();
            $grid->feedback_ave()->sortable();
            $grid->feedback_rating()->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->is('user_id');
                $filter->like('organization');
                $filter->between('apply_date')->datetime();
                $filter->is('status');
                $filter->like('website');
                $filter->between('commissions_today');
                $filter->between('commissions_month');
                $filter->between('commissions_last_month');
                $filter->between('commissions_total');
                $filter->between('sales_today');
                $filter->between('sales_month');
                $filter->between('sales_last_month');
                $filter->between('sales_total');
                $filter->between('hits_today');
                $filter->between('hits_month');
                $filter->between('hits_last_month');
                $filter->between('hits_total');
                $filter->is('group');
                $filter->is('referred');
                $filter->between('hit_commission');
                $filter->between('lead_commission');
                $filter->between('sale_commission');
                $filter->like('sign_up_campaign');
                $filter->is('country');
                $filter->like('state');
                $filter->like('tags');
                $filter->between('number_of_sales_today');
                $filter->between('commissions_sales_today');
                $filter->between('number_of_leads_today');
                $filter->between('commissions_leads_today');
                $filter->between('number_of_two_tier_today');
                $filter->between('commissions_two_tier_today');
                $filter->between('number_of_bonuses_today');
                $filter->between('commissions_bonus_today');
                $filter->between('number_of_pp_calls_today');
                $filter->between('commissions_pp_call_today');
                $filter->between('number_of_leapfrogs_today');
                $filter->between('commissions_leapfrog_today');
                $filter->between('number_of_sales_month');
                $filter->between('commissions_sales_month');
                $filter->between('number_of_leads_month');
                $filter->between('commissions_leads_month');
                $filter->between('number_of_two_tier_month');
                $filter->between('commissions_two_tier_month');
                $filter->between('number_of_bonuses_month');
                $filter->between('commissions_bonus_month');
                $filter->between('number_of_pp_call_smonth');
                $filter->between('commissions_pp_call_month');
                $filter->between('number_of_leapfrogs_month');
                $filter->between('commissions_leapfrog_month');
                $filter->between('number_of_sales_last_month');
                $filter->between('commissions_sales_last_month');
                $filter->between('number_of_leads_last_month');
                $filter->between('commissions_leads_last_month');
                $filter->between('number_of_two_tier_last_month');
                $filter->between('commissions_two_tier_last_month');
                $filter->between('number_of_bonuses_last_month');
                $filter->between('commissions_bonus_last_month');
                $filter->between('number_of_pp_calls_last_month');
                $filter->between('commissions_pp_call_last_month');
                $filter->between('number_of_leapfrogs_last_month');
                $filter->between('commissions_leapfrog_last_month');
                $filter->like('notes');
                $filter->between('feedback_count');
                $filter->between('feedback_ave');
                $filter->between('feedback_rating');
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
        return Admin::form(ReportAffiliate::class, function (Form $form) {

            $form->display('user_id');
            $form->display('organization');
            $form->display('apply_date');
            $form->display('status');
            $form->display('website');
            $form->display('commissions_today');
            $form->display('commissions_month');
            $form->display('commissions_last_month');
            $form->display('commissions_total');
            $form->display('sales_today');
            $form->display('sales_month');
            $form->display('sales_last_month');
            $form->display('sales_total');
            $form->display('hits_today');
            $form->display('hits_month');
            $form->display('hits_last_month');
            $form->display('hits_total');
            $form->display('group');
            $form->display('referred');
            $form->display('hit_commission');
            $form->display('lead_commission');
            $form->display('sale_commission');
            $form->display('sign_up_campaign');
            $form->display('country');
            $form->display('state');
            $form->display('tags');
            $form->display('number_of_sales_today');
            $form->display('commissions_sales_today');
            $form->display('number_of_leads_today');
            $form->display('commissions_leads_today');
            $form->display('number_of_two_tier_today');
            $form->display('commissions_two_tier_today');
            $form->display('number_of_bonuses_today');
            $form->display('commissions_bonus_today');
            $form->display('number_of_pp_calls_today');
            $form->display('commissions_pp_call_today');
            $form->display('number_of_leapfrogs_today');
            $form->display('commissions_leapfrog_today');
            $form->display('number_of_sales_month');
            $form->display('commissions_sales_month');
            $form->display('number_of_leads_month');
            $form->display('commissions_leads_month');
            $form->display('number_of_two_tier_month');
            $form->display('commissions_two_tier_month');
            $form->display('number_of_bonuses_month');
            $form->display('commissions_bonus_month');
            $form->display('number_of_pp_call_smonth');
            $form->display('commissions_pp_call_month');
            $form->display('number_of_leapfrogs_month');
            $form->display('commissions_leapfrog_month');
            $form->display('number_of_sales_last_month');
            $form->display('commissions_sales_last_month');
            $form->display('number_of_leads_last_month');
            $form->display('commissions_leads_last_month');
            $form->display('number_of_two_tier_last_month');
            $form->display('commissions_two_tier_last_month');
            $form->display('number_of_bonuses_last_month');
            $form->display('commissions_bonus_last_month');
            $form->display('number_of_pp_calls_last_month');
            $form->display('commissions_pp_call_last_month');
            $form->display('number_of_leapfrogs_last_month');
            $form->display('commissions_leapfrog_last_month');
            $form->display('notes');
            $form->display('feedback_count');
            $form->display('feedback_ave');
            $form->display('feedback_rating');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableListButton();
            });
            $form->disableReset();
            $form->disableSubmit();
        });
    }
}
