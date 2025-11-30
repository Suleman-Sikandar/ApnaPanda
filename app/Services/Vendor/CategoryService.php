<?php
namespace App\Services\Vendor;
class CategoryService{
    public function index()
    {
        return view('vendor.category.listing');
    }
}