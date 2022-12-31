<?php

use Codedhub\Roicalculus\Http\Controllers;
use Codedhub\Roicalculus\Models\calcplan;
use Codedhub\Roicalculus\Models\earnings;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'Codedhub\Roicalculus\Http\Controllers'],function () {

   Route::get('/coded','Roicalculus@index');
   Route::post('/submitplan', 'Roicalculus@submitplan');
   Route::get('deleterecord', function (earnings $earnings) {
        $earnings->all()->toQuery()->delete();
        return response()->json('records deleted successfully');
    });
    Route::get('insertrecord', function (calcplan $plans) {

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

        return response()->json('plan record created successfully');
    });



});




