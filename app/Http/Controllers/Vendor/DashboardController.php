<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vendor\DashboardService;
class DashboardController extends Controller
{
    public $dashboardService;
    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        $vendor = \App\Models\TblVendorModel::where('user_id', $userId)->first();

        if (!$vendor || !$vendor->is_face_verified) {
            return redirect()->route('vendor.profile', $userId)->with('error', 'Please complete your profile and face verification to access the dashboard.');
        }

        return $this->dashboardService->index();
    }

    
}
