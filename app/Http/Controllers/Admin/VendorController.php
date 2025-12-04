<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\VendorService;
class VendorController extends Controller
{
    public $vendorService;
    public function __construct(VendorService $vendorService)
    {
        $this->vendorService=$vendorService;
    }

    public function index()
    {
        return $this->vendorService->index();
    }

    public function show($id)
    {
        return $this->vendorService->show($id);
    }
    public function approve($id)
    {
        return $this->vendorService->approve($id);
    }

    public function reject($id)
    {
        return $this->vendorService->reject($id);
    }
    public function rejectUpdate(Request $request, $id)
    {
        return $this->vendorService->rejectUpdate($request,$id);
    }
    public function suspend($id)
    {
        return $this->vendorService->suspend($id);
    }
    public function suspendUpdate(Request $request, $id)
    {
        return $this->vendorService->suspendUpdate($request,$id);
    }
    public function pendingApproval()
    {
        return $this->vendorService->pendingApproval();
    }
}
