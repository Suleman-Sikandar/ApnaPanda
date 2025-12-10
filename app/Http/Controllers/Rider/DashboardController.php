<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Rider\DashboardService;
class DashboardController extends Controller
{
    public $dashboardService;
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService=$dashboardService;
    }

    public function index($id)
    {
        return $this->dashboardService->index($id);
    }
}
