<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Customer\DashboardService;
class DashboardController extends Controller
{
    public $dashboardService;
    public function __construct()
    {
        $this->dashboardService=new DashboardService();
    }

    public function index()
    {
        return $this->dashboardService->index();
    }

    public function listing()
    {
        return $this->dashboardService->listing();
    }

    public function cart()
    {
        return $this->dashboardService->cart();
    }
    public function checkout()
    {
        return $this->dashboardService->checkout();
    }

    public function track()
    {
        return $this->dashboardService->track();
    }
    public function order()
    {
        return $this->dashboardService->order();
    }
  
}
