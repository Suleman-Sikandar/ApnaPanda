<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
class RoleController extends Controller
{
    public $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        return $this->roleService->index();
    }

    public function store(Request $request)
    {
        return $this->roleService->store($request);
    }

    public function destroy($id)
    {
        return $this->roleService->destroy($id);
    }

    public function edit($id)
    {
        return $this->roleService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->roleService->update($request, $id);
    }
}
