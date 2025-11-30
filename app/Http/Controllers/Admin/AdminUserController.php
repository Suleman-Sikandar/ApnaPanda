<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\AdminService;
class AdminUserController extends Controller
{
    public $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService=$adminService;
    }

    public function index()
    {
        return $this->adminService->index();
    }

    public function store(Request $request)
    {
        return $this->adminService->store($request);
    }

    public function edit($id)
    {
        return $this->adminService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->adminService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->adminService->destroy($id);
    }

    public function show($id)
    {
        return $this->adminService->show($id);
    }
}
