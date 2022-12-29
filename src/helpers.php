<?php

namespace Codedhub\Roicalculus;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

trait helpers

{
    public $date;

    public function realDate()
    {
        $this->date = Carbon::now()->timezone(config('codedroi.time_zone'));
        return $this->date;
    }

    public function getnumberOfDays($duration)
    {
        //get the investment number of days
        $durations = $duration;
        $durations = str_replace("Days"," ",$durations);
        $durations = intval($durations);

        return $durations;
    }

    /**
     * filters strings out of the payout days, and return appropriate integer for time calculations.
     * @param string
     */
    public function getPayoutDays($payoutdays)
    {
        $increment_time = $payoutdays;
        $increment_time = str_replace("day", " ",$increment_time);
        $increment_time = intval($increment_time);
        return $increment_time;
    }

    /**
     * calculate the next profit days using the filter result from getPayoutDays.
     * if getPayoutDays is null | empty, this method will default to 24hrs (1) DAY
     * @param mixed $int
     */
    public function nextProfitCount($Count)
    {

         $increment_time = $this->getPayoutDays(true) == true ? $this->getPayoutDays(true) : $Count;
         $next_profit_date = date('Y-m-d h:i:s',strtotime("+$increment_time day", strtotime($this->realDate())));
         return $next_profit_date;
    }

}
