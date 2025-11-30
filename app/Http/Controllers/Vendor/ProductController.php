<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vendor\ProductService;
class ProductController extends Controller
{
    public $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        return $this->productService->index();
    }
}
