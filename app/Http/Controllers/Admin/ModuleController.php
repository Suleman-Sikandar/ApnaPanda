<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ModuleService;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    // ===========================
    // LISTING PAGE
    // ===========================
    public function index()
    {
        return $this->moduleService->index();
    }

    // ===========================
    // STORE MODULE
    // ===========================
    public function store(Request $request)
    {
        return $this->moduleService->store($request);
    }

    // ===========================
    // EDIT FETCH DATA
    // ===========================
    public function edit($id)
    {
        return $this->moduleService->edit($id);
    }

    // ===========================
    // UPDATE MODULE
    // ===========================
    public function update(Request $request, $id)
    {
        return $this->moduleService->update($request, $id);
    }

    // ===========================
    // DELETE MODULE
    // ===========================
    public function destroy($id)
    {
        return $this->moduleService->destroy($id);
    }
}
