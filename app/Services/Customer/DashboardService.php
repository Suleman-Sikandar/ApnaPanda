<?php
namespace App\Services\Customer;

use App\Models\TblProductCategory;
use App\Models\TblProduct;
use App\Models\TblVendorModel;

class DashboardService
{
    public function index()
    {
        // Fetch all categories from database
        $categories = TblProductCategory::all();
        
        // Get category filter from request
        $categoryId = request()->get('category');
        
        $productsQuery = TblProduct::with(['category', 'vendor.users', 'images'])
                        ->where('status', 'active');
        
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
        
        $products = $productsQuery->latest()->get();
        
        $selectedCategory = $categoryId ? TblProductCategory::find($categoryId) : null;
        
        $vendors = TblVendorModel::with('users')
                        ->where('status', 'active')
                        ->get();
        
        return view('customer.dashboard', compact('categories', 'products', 'vendors', 'selectedCategory'));
    }

    public function listing()
    {
        $data = array();
        $data['pageTitle'] = 'Product Listing';
        $data['subTitle'] = 'Customer';
        return view('customer.product.lisitng')->with($data);
    }

    public function cart()
    {
        $data = array();
        $data['pageTitle'] = 'Cart';
        $data['subTitle'] = 'Customer';
        return view('customer.product.cart')->with($data);
    }

    public function checkout()
    {
        $data = array();
        $data['pageTitle'] = 'Checkout';
        $data['subTitle'] = 'Customer';
        return view('customer.product.checkout')->with($data);
    }

    public function track()
    {
        $data = array();
        $data['pageTitle'] = 'Track Order';
        $data['subTitle'] = 'Customer';
        return view('customer.product.tracking')->with($data);
    }

    public function order()
    {
        $data = array();
        $data['pageTitle'] = 'My Orders';
        $data['subTitle'] = 'Customer';
        return view('customer.product.order')->with($data);
    }
}