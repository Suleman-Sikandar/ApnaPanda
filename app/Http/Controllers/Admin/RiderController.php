<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\RiderService;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public $riderService;

    public function __construct(RiderService $riderService)
    {
        $this->riderService = $riderService;
    }

    public function index()
    {
        return $this->riderService->index();
    }

    public function show($id)
    {
        return $this->riderService->show($id);
    }

    public function approve($id)
    {
        return $this->riderService->approve($id);
    }

    public function reject($id)
    {
        return $this->riderService->reject($id);
    }

    public function rejectUpdate(Request $request, $id)
    {
        return $this->riderService->rejectUpdate($request, $id);
    }

    public function suspend($id)
    {
        return $this->riderService->suspend($id);
    }

    public function suspendUpdate(Request $request, $id)
    {
        return $this->riderService->suspendUpdate($request, $id);
    }

    public function pendingApproval()
    {
        return $this->riderService->pendingApproval();
    }
}

