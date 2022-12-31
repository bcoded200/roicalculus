<?php

namespace Codedhub\Roicalculus\Http\Controllers;

use Codedhub\Roicalculus\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedhub\Roicalculus\Models\calcplan;
use Codedhub\Roicalculus\Models\earnings;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Roicalculus extends Controller
{
    use helpers;

    public $allplans;
    public $earnings;

    public function __construct()
    {
        // $this->middleware(['auth']);

    }

    public function index()
    {

        $allplans = calcplan::all();
        $invested = earnings::all();

        return view('coded::index', compact(
            'allplans',
            'invested'
        )
        );
    }

    public function submitplan(Request $request)
    {

        $date = $this->realDate();
        $amount = $request->amount;
        $plan = $request->plan;

        $session = session()->put(['success' => "hello world"]);



        $plan = calcplan::where("id", $request->plan)->first();


        //get the investment number of days

        $duration = $plan->duration;
        $duration = $this->getDuration($duration);


        //calculate the investment duration  date-time
        $finaldate = $this->getFinalDate($duration);

        //check the remaining days for the investment
        $remainingdaysforinvestment = $this->DateDiff($date, $finaldate);

        //get the amount the user invested
        $invested_amount = $request->amount;

        //get the percentage amount for each dynamic plan
        $percent = $plan->percentage;
        //  $percent = round($percent);

        //get the percentage odepending on amount invested
        $daily_roi = $this->getPercentage($percent, $invested_amount);
        //  $daily_roi = round($daily_roi);



        //overall return after the maturity date
        $overall_return = $daily_roi * $duration;

        // dd($overall_return.' '.'==>' . 'daily roi'. ' ' . $daily_roi);

        //get the increment date
        $increment_time = $plan->payout;
        $increment_time = $this->getIncrementCount($increment_time);


        //get the nextprofit date
        $next_profit_date = $this->nextProfitCount($increment_time);

        $earnings = new earnings;



        //feed info to the earnings table
        // dd($overall_return.' '.'==>' . 'daily roi'. ' ' . $daily_roi);
        $earnings->amount_invested = request()->amount;
        $earnings->plan_name = $plan->bundle;
        $earnings->earned_amount = 0;
        $earnings->date_invested = $date;
        $earnings->end_date = $finaldate;
        // $earnings->total_return = 0;
        $earnings->expected_return = $overall_return;
        $earnings->nextprofit_date = $next_profit_date;
        $earnings->user_id = 1;
        $earnings->invested_by = 'codedhub';
        $earnings->email = 'demo@codedhub.com';
        $earnings->plan_id = $plan->id;
        $earnings->method = 'codedCustom'; //new
        $earnings->counter = 0;
        $earnings->save();

        return back()->with([
            'success' => "You have invested successfully! go ahead and enable crun job to expirience live trading,
                    if you are on localhost via command line, type: php artisan schedule:work. If you are on shared
                    hosting, login to cpanel and set a crun job with the correct part pointing to laravel Artisan file.
                "
        ])->withInput();
    }




}
