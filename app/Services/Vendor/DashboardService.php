<?php
namespace App\Services\Vendor;
class DashboardService
{
    public function index()
    {
        $data=[
            'pageTitle' => 'Dashboard',
            'subTitle' => 'Vendor',
        ];
       return view('vendor.dashboard')->with($data);
    }
   
}