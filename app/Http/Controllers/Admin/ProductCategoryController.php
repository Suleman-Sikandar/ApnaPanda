<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductCategoryService;

class ProductCategoryController extends Controller
{
    protected $product;

    public function __construct(ProductCategoryService $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product->index();
    }

    public function store(Request $request)
    {
        return $this->product->store($request);
    }

    public function edit($id)
    {
        return $this->product->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->product->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->product->destroy($id);
    }
}
