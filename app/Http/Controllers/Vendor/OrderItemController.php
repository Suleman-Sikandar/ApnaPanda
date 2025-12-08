<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vendor\OrderItemService;

class OrderItemController extends Controller
{
    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        return $this->orderItemService->index();
    }

    public function store(Request $request)
    {
        return $this->orderItemService->store($request);
    }

    public function edit($id)
    {
        return $this->orderItemService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->orderItemService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->orderItemService->destroy($id);
    }
}
