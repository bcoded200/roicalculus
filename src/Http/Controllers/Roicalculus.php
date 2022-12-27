<?php

namespace Codedhub\Roicalculus\Http\Controllers;

use Codedhub\Roicalculus\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedhub\Roicalculus\Models\calcplan;

class Roicalculus extends Controller

{
    use helpers;

    public function index()
    {

        dd(calcplan::all());
        return view('coded::calculate');
    }

}
