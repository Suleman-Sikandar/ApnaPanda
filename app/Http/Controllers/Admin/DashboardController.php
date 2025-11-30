<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can add data fetching logic here
        // For example:
        // $totalOrders = Order::count();
        // $totalRevenue = Order::sum('total_amount');
        // $activeVendors = Vendor::where('status', 'active')->count();
        // $totalCustomers = User::where('role', 'customer')->count();
        
        return view('admin.dashboard');
    }
}
