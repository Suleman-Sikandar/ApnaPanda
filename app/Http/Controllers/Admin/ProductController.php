<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;

class ProductController extends Controller
{
    protected $productService;

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

    public function show($id)
    {
        return $this->productService->show($id);
    }

    public function deleteImage($id)
    {
        return $this->productService->deleteImage($id);
    }

    public function active($id) { return $this->productService->active($id); }
    public function outOfStock($id) { return $this->productService->outOfStock($id); }
    public function pending($id) { return $this->productService->pending($id); }
    public function ban($id) { return $this->productService->ban($id); }
    public function banUpdate(Request $request, $id) { return $this->productService->banUpdate($request, $id); }
}
