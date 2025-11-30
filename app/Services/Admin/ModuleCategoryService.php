<?php

namespace App\Services\Admin;

use App\Models\TblModuleCategory;
use Illuminate\Http\Request;

class ModuleCategoryService
{
    public function index()
    {
        $categories = TblModuleCategory::orderBy('display_order', 'ASC')->get();
        return view('admin.module_categories.listing', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name'          => 'required|string|max:100|unique:tbl_module_categories,name',
                'display_order' => 'nullable|integer|unique:tbl_module_categories,display_order',
                'is_active'     => 'required|boolean',
            ]);

            $category = TblModuleCategory::create($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Module Category created successfully!',
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


    public function edit($id)
    {
        try {
            $category = TblModuleCategory::findOrFail($id);

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


    public function update(Request $request, $id)
    {
        try {
            $category = TblModuleCategory::findOrFail($id);

            $validate = $request->validate([
                'name'          => "required|string|max:100|unique:tbl_module_categories,name,$id",
                'display_order' => "nullable|integer|unique:tbl_module_categories,display_order,$id",
                'is_active'     => 'required|boolean',
            ]);

            $category->update($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Module Category updated successfully!',
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


    public function destroy($id)
    {
        try {
            $category = TblModuleCategory::findOrFail($id);
            $category->delete();

            return response()->json([
                'status'  => true,
                'success' => 'Module Category deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Unable to delete record.',
            ], 500);
        }
    }
}
