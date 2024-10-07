<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeControllers extends Controller
{
    //

    public function dashboard(){
        return view('dashboard.dashboard');
    }
}
