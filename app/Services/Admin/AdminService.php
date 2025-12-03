<?php

namespace App\Services\Admin;

use App\Models\TblAdmin;
use App\Models\TblRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminService
{
    public function index()
    {
        $users = TblAdmin::with('roles')->get(); // updated
        $roles = TblRole::all();
        return view('admin.user.listing', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        Log::info('Admin Store Request:', $request->all());
        try {
            $validate = $request->validate([
                'name'          => 'required|string|max:50',
                'email'         => 'required|email|unique:tbl_admin,email',
                'phone'         => 'required|string|min:11|max:15',
                'password'      => 'required|string|min:8|max:50',
                'profile_image' => 'nullable|file|image|mimes:jpg,jpeg,png',

                // updated → multiple roles stored in pivot
                'role_ids'      => 'nullable|array',
                'role_ids.*'    => 'exists:tbl_roles,id',
            ]);

            Log::info('Validation Passed');

            $user = new TblAdmin();
            $user->name     = $validate['name'];
            $user->email    = $validate['email'];
            $user->phone    = $validate['phone'];
            $user->password = Hash::make($validate['password']);

            if ($request->hasFile('profile_image')) {
                $image     = $request->file('profile_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('admin/profile_image', $imageName, 'public');
                $user->profile_image = 'admin/profile_image/' . $imageName;
            }

            $user->save();

            // attach roles to pivot table
            if (!empty($validate['role_ids'])) {
                $user->roles()->sync($validate['role_ids']);
            }

            Log::info('User Saved with Roles:', $user->toArray());

            return response()->json([
                'status'  => true,
                'success' => 'Admin created successfully!',
                'data'    => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('General Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $user = TblAdmin::with('roles')->find($id);

        if ($user) {
            return response()->json([
                'status' => true,
                'success' => 'Data Fetched Successfully',
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role_ids' => $user->roles->pluck('id'), // updated
                'profile_image' => $user->profile_image,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'User not found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'name'          => 'required|string|max:50',
                'email'         => 'required|email|unique:tbl_admin,email,' . $id,
                'phone'         => 'required|string|min:11|max:15',
                'profile_image' => 'nullable|file|image|mimes:jpg,jpeg,png',

                // updated pivot roles
                'role_ids'      => 'nullable|array',
                'role_ids.*'    => 'exists:tbl_roles,id',
            ]);

            $user = TblAdmin::find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'error'  => 'User not found',
                ], 404);
            }

            $user->name = $validate['name'];
            $user->email = $validate['email'];
            $user->phone = $validate['phone'];

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('profile_image')) {
                $image     = $request->file('profile_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('admin/profile_image', $imageName, 'public');
                $user->profile_image = 'admin/profile_image/' . $imageName;
            }

            $user->save();

            // sync pivot roles
            if (isset($validate['role_ids'])) {
                $user->roles()->sync($validate['role_ids']);
            }

            return response()->json([
                'status'  => true,
                'success' => 'Admin updated successfully!',
                'data'    => $user
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
            $user = TblAdmin::find($id);

            if ($user) {
                // delete pivot roles also automatically
                $user->roles()->detach();

                $user->delete();

                return response()->json([
                    'status' => true,
                    'success' => 'Admin deleted successfully!',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => 'User not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $user = TblAdmin::with('roles')->findOrFail($id);
        return view('admin.user.profile', compact('user'));
    }
}
