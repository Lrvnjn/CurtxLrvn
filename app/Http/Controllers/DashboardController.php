<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function sta()
    {
        return view('staff.dashboard');
    }
    public function mun()
    {
        return view('president.dashboard');
    }
}
