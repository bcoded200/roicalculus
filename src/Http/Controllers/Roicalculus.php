<?php

namespace Codedhub\Roicalculus\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class Roicalculus extends Controller

{

    public function index()
    {

        return view('coded::calculate');
    }

}
