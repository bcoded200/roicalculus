<?php

// namespace Codedhub\Roicalculus\Database\Seeders;
/**
 * seeder not used in our package!! ignore this line and the whole file
 * **/
use Codedhub\Roicalculus\Models\calcplan;
use \Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class calcplanseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        calcplan::create([
            'bundle' => strtoupper(Str::random(10)),
            'minimium' => rand(200,500000),
            'maximium' => rand(500,800000),
            'percentage' => rand(10,200),
            'referal_bonus' => rand(10,100),
            'duration' => rand(10,200).'Days',
            'payout' => rand(1,8).'Day',
            'no_of_times'=>  rand(1,20),
            'max_reinvest' => rand(1,10)
        ]);


    }
}

