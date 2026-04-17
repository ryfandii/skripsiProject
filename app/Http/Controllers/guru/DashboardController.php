<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('guru.dashboard');
    }
}