<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\BusinessService;
class BusinessController extends Controller
{
    public $business;
    public function __construct(BusinessService $business)
    {
        $this->business=$business;
    }

    public function index()
    {
        return $this->business->index();
    }

    public function store(Request $request)
    {
        return $this->business->store($request);
    }

    public function edit($id)
    {
        return $this->business->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->business->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->business->destroy($id);
    }
}
