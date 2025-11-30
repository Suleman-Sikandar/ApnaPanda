<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vendor\OrderService;
class OrderController extends Controller
{
    public $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService=$orderService;
    }

    public function index()
    {
        return $this->orderService->index();
    }
}
