<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('MainApp.dashboard');
    }
}
