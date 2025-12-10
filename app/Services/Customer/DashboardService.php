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
        
        if (request()->ajax()) {
            $products = $productsQuery->latest()->paginate(12);
            return response()->json([
                'products' => $products->items(),
                'hasMore' => $products->hasMorePages(),
                'nextPage' => $products->currentPage() + 1
            ]);
        }
        
        $products = $productsQuery->latest()->paginate(12);
        
        $selectedCategory = $categoryId ? TblProductCategory::find($categoryId) : null;
        
        $vendors = TblVendorModel::with('users')
                        ->where('status', 'active')
                        ->get();
        
        return view('customer.dashboard', compact('categories', 'products', 'vendors', 'selectedCategory'));
    }

    public function productDetail($id)
    {
        $product = TblProduct::with(['category', 'vendor.users', 'images'])
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
        
        $categories = TblProductCategory::all();
        
        $data = array();
        $data['pageTitle'] = $product->name;
        $data['subTitle'] = 'Product Details';
        $data['product'] = $product;
        $data['categories'] = $categories;
        
        return view('customer.product.detail')->with($data);
    }

    public function track()
    {
        $data = array();
        $data['pageTitle'] = 'Track Order';
        $data['subTitle'] = 'Customer';
        return view('customer.product.tracking')->with($data);
    }
}