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
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->index();
    }

    public function store(Request $request)
    {
        return $this->productService->store($request);
    }

    public function edit($id)
    {
        return $this->productService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->productService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->productService->destroy($id);
    }

    public function deleteImage($id)
    {
        return $this->productService->deleteImage($id);
    }
}
