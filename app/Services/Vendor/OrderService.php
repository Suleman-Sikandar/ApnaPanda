<?php
namespace App\Services\Vendor;

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
        $userId = Auth::id();
        $query = TblOrder::with(['customer', 'vendor', 'paymentMethod'])
                    ->where('vendor_id', $userId);

        // Filter by Status
        if (request()->has('status') && request()->status != '') {
             $query->where('order_status', request()->status);
        }

        $orders = $query->orderBy('id', 'desc')->get();
        
        // Fetch data for dropdowns
        $customers = User::all(); 
        $paymentMethods = TblPaymentMethode::all();
        
        // Pass current status filter to view for Title
        $filterStatus = request()->status;

        return view('vendor.order.listing', compact('orders', 'customers', 'paymentMethods', 'filterStatus'));
    }

    public function show($id)
    {
        $userId = Auth::id();
        $order = TblOrder::with([
            'customer', 
            'vendor.users', 
            'paymentMethod', 
            'statusLogs.user',
            'statusLogs.admin',
            'orderItems.product'
        ])
        ->where('vendor_id', $userId)
        ->findOrFail($id);

        // Fetch data for dropdowns (needed for edit drawer included in detail view)
        $customers = User::all(); 
        $paymentMethods = TblPaymentMethode::all();

        return view('vendor.order.detail', compact('order', 'customers', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'nullable|exists:users,id',
            'order_status'      => 'required|string',
            'payment_amount'    => 'nullable|integer',
            'payment_method_id' => 'nullable|exists:tbl_payment_methodes,id',
            'delivery_address'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['vendor_id'] = $userId; // Automatically set vendor_id to logged-in vendor
        
        TblOrder::create($data);

        return response()->json(['status' => true, 'success' => 'Order created successfully!']);
    }

    public function edit($id)
    {
        $userId = Auth::id();
        $order = TblOrder::with(['customer', 'vendor', 'paymentMethod', 'statusLogs.user', 'statusLogs.admin'])
                    ->where('vendor_id', $userId)
                    ->findOrFail($id);
        return response()->json(['status' => true, 'data' => $order]);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'nullable|exists:users,id',
            'order_status'      => 'required|string',
            'payment_amount'    => 'nullable|integer',
            'payment_method_id' => 'nullable|exists:tbl_payment_methodes,id',
            'delivery_address'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $order = TblOrder::where('vendor_id', $userId)->findOrFail($id);
        $oldStatus = $order->order_status;
        
        $data = $request->all();
        $data['vendor_id'] = $userId; // Ensure vendor_id doesn't change
        
        $order->update($data);

        // Log status change if it changed
        if ($oldStatus !== $request->order_status) {
            OrderStatusLog::create([
                'order_id' => $order->id,
                'old_status' => $oldStatus,
                'status_changed_to' => $request->order_status,
                'user_type' => 'vendor',
                'user_id' => $userId, 
                'notes' => 'Status changed by Vendor',
                'created_at' => now(),
            ]);
        }

        return response()->json(['status' => true, 'success' => 'Order updated successfully!']);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $order = TblOrder::where('vendor_id', $userId)->findOrFail($id);
        $order->delete();
        return response()->json(['status' => true, 'success' => 'Order deleted successfully!']);
    }
}