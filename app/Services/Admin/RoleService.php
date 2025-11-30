<?php
namespace App\Services\Admin;

use App\Models\TblRole;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class RoleService
{
    public function index()
    {
        $roles=TBlROle::orderBy('display_order', 'ASC')->get();
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

    public function destroy($id)
    {
        $role=TblRole::findOrFail($id);
        if($role)
        {
            $role->delete();
            return response()->json([
                'status' => true,
                'success' => "Role Deleted SuccessFully",
            ]);
        }else
        {
            return response()->json([
                'status' => false,
                'error' => 'SomeThing Went Wrong',
            ]);
        }
    }
}
