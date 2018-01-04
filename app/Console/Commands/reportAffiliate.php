<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class reportAffiliate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shareasale:reportaffiliate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShareASale Report Affiliate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $action = 'report-affiliate';
        $output = \Aff_Helper::callSasApi($action);
        if (!$output) {
            return;
        }

        $datas = simplexml_load_string($output);
        if ($datas) {
            DB::table('shareasale_reportaffiliate')->truncate();
            foreach ($datas as $data) {
                $ra = new \App\Models\ReportAffiliate();
                $ra->user_id = $data->userid;
                $ra->organization = $data->organization;
                $ra->apply_date = $data->applydate;
                $ra->status = $data->status;
                $ra->website = $data->website;
                $ra->commissions_today = $data->commissionstoday;
                $ra->commissions_month = $data->commissionsmonth;
                $ra->commissions_last_month = $data->commissionslastmonth;
                $ra->commissions_total = $data->commissionstotal;
                $ra->sales_today = $data->salestoday;
                $ra->sales_month = $data->salesmonth;
                $ra->sales_last_month = $data->saleslastmonth;
                $ra->sales_total = $data->salestotal;
                $ra->hits_today = $data->hitstoday;
                $ra->hits_month = $data->hitsmonth;
                $ra->hits_last_month = $data->hitslastmonth;
                $ra->hits_total = $data->hitstotal;
                $ra->group = $data->group;
                $ra->referred = $data->referred;
                $ra->hit_commission = $data->hitcommission;
                $ra->lead_commission = $data->leadcommission;
                $ra->sale_commission = $data->salecommission;
                $ra->sign_up_campaign = $data->signupcampaign;
                $ra->country = $data->country;
                $ra->state = $data->state;
                $ra->tags = $data->tags;
                $ra->number_of_sales_today = $data->numberofsalestoday;
                $ra->commissions_sales_today = $data->commissionssalestoday;
                $ra->number_of_leads_today = $data->numberofleadstoday;
                $ra->commissions_leads_today = $data->commissionsleadstoday;
                $ra->number_of_two_tier_today = $data->numberoftwotiertoday;
                $ra->commissions_two_tier_today = $data->commissionstwotiertoday;
                $ra->number_of_bonuses_today = $data->numberofbonusestoday;
                $ra->commissions_bonus_today = $data->commissionsbonustoday;
                $ra->number_of_pp_calls_today = $data->numberofppcallstoday;
                $ra->commissions_pp_call_today = $data->commissionsppcalltoday;
                $ra->number_of_leapfrogs_today = $data->numberofleapfrogstoday;
                $ra->commissions_leapfrog_today = $data->commissionsleapfrogtoday;
                $ra->number_of_sales_month = $data->numberofsalesmonth;
                $ra->commissions_sales_month = $data->commissionssalesmonth;
                $ra->number_of_leads_month = $data->numberofleadsmonth;
                $ra->commissions_leads_month = $data->commissionsleadsmonth;
                $ra->number_of_two_tier_month = $data->numberoftwotiermonth;
                $ra->commissions_two_tier_month = $data->commissionstwotiermonth;
                $ra->number_of_bonuses_month = $data->numberofbonusesmonth;
                $ra->commissions_bonus_month = $data->commissionsbonusmonth;
                $ra->number_of_pp_call_smonth = $data->numberofppcallsmonth;
                $ra->commissions_pp_call_month = $data->commissionsppcallmonth;
                $ra->number_of_leapfrogs_month = $data->numberofleapfrogsmonth;
                $ra->commissions_leapfrog_month = $data->commissionsleapfrogmonth;
                $ra->number_of_sales_last_month = $data->numberofsaleslastmonth;
                $ra->commissions_sales_last_month = $data->commissionssaleslastmonth;
                $ra->number_of_leads_last_month = $data->numberofleadslastmonth;
                $ra->commissions_leads_last_month = $data->commissionsleadslastmonth;
                $ra->number_of_two_tier_last_month = $data->numberoftwotierlastmonth;
                $ra->commissions_two_tier_last_month = $data->commissionstwotierlastmonth;
                $ra->number_of_bonuses_last_month = $data->numberofbonuseslastmonth;
                $ra->commissions_bonus_last_month = $data->commissionsbonuslastmonth;
                $ra->number_of_pp_calls_last_month = $data->numberofppcallslastmonth;
                $ra->commissions_pp_call_last_month = $data->commissionsppcalllastmonth;
                $ra->number_of_leapfrogs_last_month = $data->numberofleapfrogslastmonth;
                $ra->commissions_leapfrog_last_month = $data->commissionsleapfroglastmonth;
                $ra->notes = $data->notes;
                $ra->feedback_count = $data->feedbackcount;
                $ra->feedback_ave = $data->feedbackave;
                $ra->feedback_rating = $data->feedbackrating;
                $ra->save();
            }
        }
    }
}
