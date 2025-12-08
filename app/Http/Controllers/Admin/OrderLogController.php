<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;

class OrderLogController extends Controller
{
    public function index()
    {
        $logs = OrderStatusLog::with(['order', 'user', 'admin'])->orderBy('created_at', 'desc')->get();
        return view('admin.order_logs.listing', compact('logs'));
    }

    public function destroy($id)
    {
        $log = OrderStatusLog::findOrFail($id);
        $log->delete();
        return response()->json(['status' => true, 'success' => 'Log deleted successfully!']);
    }
}
