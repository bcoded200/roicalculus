<?php

namespace Codedhub\Roicalculus\Console\Command;

use Codedhub\Roicalculus\helpers;
use Codedhub\Roicalculus\Models\calcplan;
use Codedhub\Roicalculus\Models\earnings;
use Codedhub\Roicalculus\Models\wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class codedroicrun extends Command
{
    use helpers;
    public $count;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codedhub:trade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to perfom automatic trading on investments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {



         //get the current live date
         $date = $this->realDate();

         $earningsModel = earnings::get();

         foreach ($earningsModel as $data)
         {

             $allplan = calcplan::where("id", $data->plan_id)->get();

            // $wallets = wallet::where("user_id",$data->user_id)->get();


             foreach ($allplan as $allplans)
             {

        //    foreach($wallets as $wallet)

                 //get the investment number of days
                $duration = $allplans->duration;
                $duration = $this->getDuration($duration);

             //increment the profit block

              if($date > $data->nextprofit_date)//be careful with this line ,
              //otherwise the sky will fall on your head!!
              {
                 /**
                  * ## logic for incrementing the ongoin plans here!!
                  *
                  * get the payout  times dynamically based on selected plan and
                  * increment profits according to payout times
                  */

                  $increment_time = $allplans->payout;
                  $increment_time = $this->getPayoutDays($increment_time);

                  //calculate the next profit date
                    $next_profit_date = $this->nextProfitCount($increment_time);

                 //get the amount the user invested
                 $invested_amount = $data->amount_invested;

                 //get the percentage amount for each  plan invested on
                 $percent = $allplans->percentage;


                 //calculate the plan percentage with the amount, user invested
                 $daily_roi = $this->getPercentage($percent,$invested_amount);

                 /**
                  * increment the user profit with the calculated percentage and wait for next profit date
                  */

                  /**
                   * codedweb changed  the old method
                   * $oldbalance+= $data->earned_amount+ $daily_roi; to the calcbalnce below!
                   */

                    //get the old balance and add to the new balance
                    $calcbalance = $data->earned_amount + $daily_roi;


                     if($data->earnings_action == 1)//1 means pause 0 means play
                     {

                         echo   $data->plan_name.' '. 'contract with invested amount of'.' '.$data->amount_invested.' '
                         .'has been paused!!';

                     }elseif($date > $data->end_date)
                     {


                         // foreach($wallets as $wallet)
                         // {


                         $data->expired = 1;
                         $data->update();


                         //logic to decrement wallet balance
                        //  if($data->method == 'LO_BALANCE')//new
                        //  {



                        //      $loancredit = $wallet->loan_balance + $data->expected_return + $data->amount_invested;
                        //      $wallet->loan_balance =$loancredit;
                        //      $wallet->update();


                        //  }else
                        //  {
                        //      $old = $wallet->coin_balance + $data->expected_return + $data->amount_invested;
                        //      $wallet->coin_balance =$old;
                        //      $wallet->update();
                        //  }




                          $details = [
                             'planname' => $allplans->bundle,
                             'amountinvested' => $data->amount_invested

                            ];

                            //    Mail::to($data->email)->send(new endtrademail($details));

                         //corrected
                         $this->count = earnings::where("end_date", "<", $date)->count();
                         echo "$this->count contract has ended";

                        //  $copyout = new expiredcontract;
                        //  $copyout->amount_invested =  $data->amount_invested;
                        //  $copyout->plan_name =  $data->plan_name;
                        //  $copyout->earned_amount =  $data->earned_amount;
                        //  $copyout->date_invested =  $data->date_invested;
                        //  $copyout->end_date =  $data->end_date;
                        //  // 'total_return',
                        //  $copyout->expected_return =  $data->expected_return;
                        //  $copyout->nextprofit_date =  $data->nextprofit_date;
                        //  $copyout->user_id =  $data->user_id;
                        //  $copyout->invested_by =  $data->invested_by;
                        //  $copyout->counter =  $data->counter;
                        //  $copyout->earnings_action =  $data->earnings_action;
                        //  $copyout->expired =  $data->expired;
                        //  $copyout->reinvest =  $data->reinvest;
                        //  $copyout->email =  $data->email;
                        //  $copyout->save();

                        //  $data->delete();




                         // }


                     }
                     elseif($data->earned_amount == $data->expected_return)
                     {
                         $this->count = earnings::where("earned_amount", "==", $data->expected_return)->count();
                         echo "$this->count contract has reached its earning limit! and queued for deletion";
                     }
                     else
                     {

                   //var_dump($data);
                   $this->count = earnings::where("plan_name",$allplans->bundle)->count();

                     //update the earnings model with the new record / result
                     $oldcounter = 1;
                     $updatecounter = $data->counter + $oldcounter;
                     $data->earned_amount = $calcbalance;
                     $data->nextprofit_date = $next_profit_date;
                     $data->counter = $updatecounter;
                     $data->update();

                     /**
                      * Email the clients after successfull Trading
                      * Crafted By (Codedwebltd)
                      */

                     $details = [

                         'planname' => $allplans->bundle,
                         'todaysprofit' => $daily_roi,
                         'daystraded' => $updatecounter,
                         'nextprofitdate' =>  $next_profit_date,
                         'totalearned' => $calcbalance,
                         'invested_by' =>  $data->invested_by,
                         'subtotal' => $allplans->duration


                        ];

                    //    Mail::to($data->email)->send(new notifytrading($details));

                         echo $this->count."Contracts Traded! $data->counter Times".PHP_EOL;
                     }

                 }


             //EOF for wallet

             }//EOF plan foreach




         } //EOF for earnings



       }//EOF handle Braces

}
