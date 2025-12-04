<?php

namespace App\Services\Admin;

use App\Models\TblProductCategory;
use Illuminate\Http\Request;

class ProductCategoryService
{
    // List all categories
    public function index()
    {
        $categories = TblProductCategory::orderBy('id', 'ASC')->get();
        return view('admin.product_categories.listing', compact('categories'));
    }

    // Store a new category
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'category_name' => 'required|string|max:100|unique:tbl_product_categories,category_name',
            ]);

            $category = TblProductCategory::create($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Product Category created successfully!',
                'data'    => $category,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage(),
            ], 500);
        }
    }

    // Get a category for editing
    public function edit($id)
    {
        try {
            $category = TblProductCategory::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => $category,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Record not found.',
            ], 404);
        }
    }

    // Update a category
    public function update(Request $request, $id)
    {
        try {
            $category = TblProductCategory::findOrFail($id);

            $validate = $request->validate([
                'category_name' => "required|string|max:100|unique:tbl_product_categories,category_name,$id",
            ]);

            $category->update($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Product Category updated successfully!',
                'data'    => $category,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a category
    public function destroy($id)
    {
        try {
            $category = TblProductCategory::findOrFail($id);
            $category->delete();

            return response()->json([
                'status'  => true,
                'success' => 'Product Category deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Unable to delete record.',
            ], 500);
        }
    }
}
