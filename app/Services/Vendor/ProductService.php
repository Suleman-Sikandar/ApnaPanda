<?php
namespace App\Services\Vendor;
class ProductService{
    public function index()
    {
        $data=[
            'pageTitle' => 'Products',
            'subTitle' => 'Product List',
        ];
        return view('vendor.product.listing')->with($data);
    }
}