<?php
namespace App\Services\Admin;

use App\Models\TblOrder;
use App\Models\User;
use App\Models\TblVendorModel;
use App\Models\TblPaymentMethode;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function index()
    {
        $query = TblOrder::with(['customer', 'vendor', 'paymentMethod']);

        // Filter by Status
        if (request()->has('status') && request()->status != '') {
             $query->where('order_status', request()->status);
        }

        $orders = $query->orderBy('id', 'desc')->get();
        
        // Fetch data for dropdowns
        $customers = User::all(); 
        $vendors = TblVendorModel::with('users')->get();
        $paymentMethods = TblPaymentMethode::all();
        
        // Pass current status filter to view for Title
        $filterStatus = request()->status;

        return view('admin.order.listing', compact('orders', 'customers', 'vendors', 'paymentMethods', 'filterStatus'));
    }

    public function show($id)
    {
        $order = TblOrder::with([
            'customer', 
            'vendor.users', 
            'paymentMethod', 
            'statusLogs.user',
            'statusLogs.admin',
            'orderItems.product'
        ])->findOrFail($id);

        // Fetch data for dropdowns (needed for edit drawer included in detail view)
        $customers = User::all(); 
        $vendors = TblVendorModel::with('users')->get();
        $paymentMethods = TblPaymentMethode::all();

        return view('admin.order.detail', compact('order', 'customers', 'vendors', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'nullable|exists:users,id',
            'vendor_id'         => 'nullable|exists:tbl_vendors,id',
            'order_status'      => 'required|string',
            'payment_amount'    => 'nullable|integer',
            'payment_method_id' => 'nullable|exists:tbl_payment_methodes,id',
            'delivery_address'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        TblOrder::create($request->all());

        return response()->json(['status' => true, 'success' => 'Order created successfully!']);
    }

    public function edit($id)
    {
        $order = TblOrder::with(['customer', 'vendor', 'paymentMethod', 'statusLogs.user', 'statusLogs.admin'])->findOrFail($id);
        return response()->json(['status' => true, 'data' => $order]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'nullable|exists:users,id',
            'vendor_id'         => 'nullable|exists:tbl_vendors,id',
            'order_status'      => 'required|string',
            'payment_amount'    => 'nullable|integer',
            'payment_method_id' => 'nullable|exists:tbl_payment_methodes,id',
            'delivery_address'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $order = TblOrder::findOrFail($id);
        $oldStatus = $order->order_status;
        $order->update($request->all());

        // Log status change if it changed
        if ($oldStatus !== $request->order_status) {
            
            $userId = Auth::guard('admin')->id() ?? Auth::id() ?? 1;
            $userType = Auth::guard('admin')->check() ? 'admin' : 'system';

            OrderStatusLog::create([
                'order_id' => $order->id,
                'old_status' => $oldStatus,
                'status_changed_to' => $request->order_status,
                'user_type' => $userType,
                'user_id' => $userId, 
                'notes' => 'Status changed by ' . ucfirst($userType),
                'created_at' => now(),
            ]);
        }

        return response()->json(['status' => true, 'success' => 'Order updated successfully!']);
    }

    public function destroy($id)
    {
        $order = TblOrder::findOrFail($id);
        $order->delete();
        return response()->json(['status' => true, 'success' => 'Order deleted successfully!']);
    }
}
