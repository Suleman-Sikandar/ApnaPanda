<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Customer\CartService;
class CartController extends Controller
{
    public $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService=$cartService;
    }

    public function index()
    {
        return $this->cartService->index();
    }

    public function store(Request $request,$id)
    {
        return $this->cartService->store($request,$id);
    }

    public function showCart($id)
    {
        return $this->cartService->showCart($id);
    }

    public function updateQty(Request $request)
    {
        return $this->cartService->updateQty($request);
    }

    public function destroy($id)
    {
        return $this->cartService->destroy($id);
    }

    public function checkout($id)
    {
        return $this->cartService->checkout($id);
    }

    public function placeOrder(Request $request)
    {
        try {
            $result = $this->cartService->placeOrder($request);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function order()
    {
        return $this->cartService->order();
    }
}
