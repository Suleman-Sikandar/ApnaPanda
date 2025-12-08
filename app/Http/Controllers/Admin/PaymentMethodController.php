<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PaymentMethodService;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index()
    {
        return $this->paymentMethodService->index();
    }

    public function store(Request $request)
    {
        return $this->paymentMethodService->store($request);
    }

    public function edit($id)
    {
        return $this->paymentMethodService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->paymentMethodService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->paymentMethodService->destroy($id);
    }
}
