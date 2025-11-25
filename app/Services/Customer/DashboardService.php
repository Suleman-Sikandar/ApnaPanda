<?php
namespace App\Services\Customer;
class DashboardService{
    public function index()
    {
        return view('customer.dashboard');
    }

    public function listing()
    {
        return view('customer.product.lisitng');
    }
    public function cart()
    {
        return view('customer.product.cart');
    }
    public function checkout()
    {
        return view('customer.product.checkout');
    }
    public function track()
    {
        return view('customer.product.tracking');
    }
    public function order()
    {
        return view('customer.product.order');
    }
}