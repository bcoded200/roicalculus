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

    public function getDuration($duration)
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
     *
     * @param mixed $int
     */
    public function nextProfitCount($Count)
    {

        $increment_time =  $Count;
         $next_profit_date = date('Y-m-d h:i:s',strtotime("+$increment_time day", strtotime($this->realDate())));
        return $next_profit_date;
    }

    static function getPercentage($PercentageAmount, $MoneyAmount)
    {
     $num = $MoneyAmount; //300
     $percent = $PercentageAmount; //3.8
     return $calc = $percent / 100 * $num;


    }

    /**
     * calculate the maturity date from a given days
    */
    public function getFinalDate($duration)
    {
        $days = "+$duration days";
        $strt_date = $this->realDate();
        $calc_strtdate = date_create($strt_date);
        $frmt_date = date_format($calc_strtdate, "m/d/Y");
        $new_date = strtotime($days, strtotime($frmt_date));
        $finaldate =  date("Y-m-d h:i:s", $new_date);
        return $finaldate;
    }

    public function getIncrementCount($string)
    {
        $increment_time = $string;
        $increment_time = str_replace(["day","Day"], " ",$increment_time);
        return $increment_time;
    }


    public function DateDiff($date1, $date2)
    {
        //formulate the difference b/w two dates
       $date1 = strtotime($date1);
       $date2 = strtotime($date2);

        $diff = abs($date1 - $date2);

        //to get the year, divide the resultant data into total seconds in a year (365*60*60*24)
        $years = floor($diff / (365*60*60*24));

        //to get the month, subtract it with years and divide the resultant date into
        //total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

        //to get the day subtract it with years and months and divide the
        //resultant date into total seconds in a days(60*60*24)
       $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));


       //to get the hours subtract it with years months and seconds and divide the resultant date into total seconds
       // in a hour (60*60)

        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

        //to get the minuites subtrat it with years months seconds and hours and
        //divide the resultant date into total seconds i.e (60)

        $minuites = floor(($diff - $years * 365 *60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days*60*60*24-$hours*60*60) /60);

        //to get the minuites , subtract it with  years , month , seconds hours and minuites

        $seconds = floor(($diff - $years * 365*60*60*24 - $months *30*60*60*24 - $days *60*60*24 - $hours*60*60 - $minuites *60));

        //print result

        $format = " $years, $months, $days, $hours, $minuites, $seconds";

        return $format;
        // %d years, %d months, %d days, %d hours, "."%d minuites, %d seconds",
    }

}
