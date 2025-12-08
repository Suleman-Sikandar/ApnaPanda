<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->orderService->index();
    }

    public function show($id)
    {
        return $this->orderService->show($id);
    }

    public function store(Request $request)
    {
        return $this->orderService->store($request);
    }

    public function edit($id)
    {
        return $this->orderService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->orderService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->orderService->destroy($id);
    }
}
