<?php
namespace App\Services\Vendor;
class OrderService{
    public function index()
    {
        return view('vendor.orders.listing');
    }
}