<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ModuleCategoryService;
class ModuleCategoryController extends Controller
{
    public $moduleCategories;
    public function __construct(ModuleCategoryService $moduleCategories)
    {
        $this->moduleCategories= $moduleCategories;
    }
    
    public function index()
    {
        return $this->moduleCategories->index();
    }

    public function store(Request $request)
    {
        return $this->moduleCategories->store($request);
    }

    public function edit($id)
    {
        return $this->moduleCategories->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->moduleCategories->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->moduleCategories->destroy($id);
    }
}
