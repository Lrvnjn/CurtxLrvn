<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function mun()
    {
        return view('president.overview');
    }
}
