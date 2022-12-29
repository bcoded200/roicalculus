<?php

namespace Codedhub\Roicalculus\Http\Controllers;

use Codedhub\Roicalculus\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedhub\Roicalculus\Models\calcplan;
use Illuminate\Support\Facades\DB;


class Roicalculus extends Controller

{
    use helpers;

    public $allplans;
    public $earnings;

    public function index()
    {

        $allplans = DB::table(config('codedroi.plans_table'))->get();
        return view('coded::index', compact(
            'allplans'
        ));
    }

    public function submitplan(Request $request)
    {

        $date = $this->realDate();

        $amount = $request->amount;
        $plan = $request->plan;





       $this->earnings =  DB::table(config('codedroi.earnings_table'))->get();

        return back();
    }




}
