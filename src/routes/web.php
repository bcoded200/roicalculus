<?php

use Codedhub\Roicalculus\Http\Controllers;
use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'Codedhub\Roicalculus\Http\Controllers'],function () {

   Route::get('/coded','Roicalculus@index');
   Route::post('/submitplan', 'Roicalculus@submitplan');



});




