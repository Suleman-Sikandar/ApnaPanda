<?php

namespace App\Services\Admin;

use App\Models\TblModule;
use Illuminate\Http\Request;
use App\Models\TblModuleCategory;
class ModuleService
{
    // ===========================
    // LISTING PAGE
    // ===========================
    public function index()
    {
        $modules = TblModule::with('category')->orderBy('display_order', 'ASC')->get();
        $categories=TblModuleCategory::all();
        return view('admin.modules.listing', compact('modules', 'categories'));
    }

    // ===========================
    // STORE MODULE
    // ===========================
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'module_category_id' => 'required|exists:tbl_module_categories,id',
                'module_name'        => 'required|string|max:100|unique:tbl_modules,module_name',
                'route'              => 'nullable|string|unique:tbl_modules,route',
                'show_in_menu'       => 'required|boolean',
                'icon_class'         => 'nullable|string|max:50',
                'display_order'      => 'nullable|integer|unique:tbl_modules,display_order',
                'is_active'          => 'required|boolean',
            ]);

            $module = TblModule::create($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Module created successfully!',
                'data'    => $module,
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

    // ===========================
    // EDIT MODULE
    // ===========================
    public function edit($id)
    {
        try {
            $module = TblModule::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => $module,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Module not found.',
            ], 404);
        }
    }

    // ===========================
    // UPDATE MODULE
    // ===========================
    public function update(Request $request, $id)
    {
        try {
            $module = TblModule::findOrFail($id);

            $validate = $request->validate([
                'module_category_id' => 'required|exists:tbl_module_categories,id',
                'module_name'        => "required|string|max:100|unique:tbl_modules,module_name,$id",
                'route'              => "nullable|string|unique:tbl_modules,route,$id",
                'show_in_menu'       => 'required|boolean',
                'icon_class'         => 'nullable|string|max:50',
                'display_order'      => "nullable|integer|unique:tbl_modules,display_order,$id",
                'is_active'          => 'required|boolean',
            ]);

            $module->update($validate);

            return response()->json([
                'status'  => true,
                'success' => 'Module updated successfully!',
                'data'    => $module,
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

    // ===========================
    // DELETE MODULE
    // ===========================
    public function destroy($id)
    {
        try {
            $module = TblModule::findOrFail($id);
            $module->delete();

            return response()->json([
                'status'  => true,
                'success' => 'Module deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error'  => 'Unable to delete module.',
            ], 500);
        }
    }
}
