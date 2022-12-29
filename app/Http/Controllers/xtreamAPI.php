<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class xtreamAPI extends Controller
{
    //
    function getData(Request $request) 
    {
        return ["name"=>$request->input('action')];
    }
}
