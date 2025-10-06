<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ChildService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $childService;
    public function __construct(ChildService $childService)
    {
        $this->childService = $childService;
    }
    public function index()
    {
        $children = $this->childService->getChildren();
        $title  = __('dashboard.dashboard');
        return view('dashboard.index', compact('children','title'));
    }
}
