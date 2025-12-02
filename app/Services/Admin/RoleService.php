<?php
namespace App\Services\Admin;

use App\Models\TblModuleCategory;
use App\Models\TblRole;
use Illuminate\Http\Request;

class RoleService
{
    public function index()
    {
        $roles = TblRole::orderBy('display_order', 'ASC')->get();
        return view('admin.role.listing', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name'          => 'required|string|unique:tbl_roles,name',
                'display_order' => 'nullable|unique:tbl_roles,display_order',
            ]);

            $role                = new TblRole();
            $role->name          = $validate['name'];
            $role->display_order = $validate['display_order'] ?? null;
            $role->save();

            return response()->json([
                'status'  => true,
                'success' => 'Role added successfully!',
            ]);

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
        $role       = TblRole::with('modules')->findOrFail($id);
        $categories = TblModuleCategory::with('modules')->orderBy('display_order')->get();

        return view('admin.role.edit', compact('role', 'categories'));
    }

    public function destroy($id)
    {
        $role = TblRole::findOrFail($id);
        if ($role) {
            $role->delete();
            return response()->json([
                'status'  => true,
                'success' => "Role Deleted SuccessFully",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error'  => 'SomeThing Went Wrong',
            ]);
        }
    }
        public function update(Request $request, $id)
        {
            try {
                $validate = $request->validate([
                    'name'          => ['required', 'string', \Illuminate\Validation\Rule::unique('tbl_roles', 'name')->ignore($id)],
                    'display_order' => ['nullable', \Illuminate\Validation\Rule::unique('tbl_roles', 'display_order')->ignore($id)],
                    'modules'       => 'array',
                ]);

                $role                = TblRole::findOrFail($id);
                $role->name          = $validate['name'];
                $role->display_order = $validate['display_order'] ?? $role->display_order;
                $role->save();

                if ($request->has('modules')) {
                    $role->modules()->sync($request->input('modules'));
                }

                return response()->json([
                    'status'  => true,
                    'success' => 'Role updated successfully!',
                ]);
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
    }
