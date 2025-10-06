<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ChildService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        $title  = __('dashboard.dashboard');
        return view('dashboard.index', compact('title'));
    }
}
