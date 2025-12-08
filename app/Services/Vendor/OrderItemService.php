<?php
namespace App\Services\Vendor;

use App\Models\TblOrderItem;
use App\Models\TblOrder;
use App\Models\TblProductCategory;
use App\Models\TblProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderItemService
{
    public function index()
    {
        $vendorId = Auth::id();
        
        // Get order items only from orders belonging to this vendor
        $orderItems = TblOrderItem::with(['order', 'productCategory', 'product'])
                        ->whereHas('order', function($query) use ($vendorId) {
                            $query->where('vendor_id', $vendorId);
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        
        // Get vendor's orders only
        $orders = TblOrder::where('vendor_id', $vendorId)->get();
        $categories = TblProductCategory::all();
        // Get vendor's products only
        $products = TblProduct::where('vendor_id', $vendorId)->get();

        return view('vendor.order_item.listing', compact('orderItems', 'orders', 'categories', 'products'));
    }

    public function store(Request $request)
    {
        $vendorId = Auth::id();
        
        $validator = Validator::make($request->all(), [
            'order_id'              => 'required|exists:tbl_orders,id',
            'product_category_id'   => 'nullable|exists:tbl_product_categories,id',
            'product_id'            => 'nullable|exists:tbl_products,id',
            'unit_price'            => 'nullable|integer',
            'quantity'              => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Verify the order belongs to this vendor
        $order = TblOrder::where('id', $request->order_id)
                    ->where('vendor_id', $vendorId)
                    ->first();
        
        if (!$order) {
            return response()->json(['status' => false, 'errors' => ['order_id' => ['This order does not belong to you']]], 422);
        }

        TblOrderItem::create($request->all());

        return response()->json(['status' => true, 'success' => 'Order Item created successfully!']);
    }

    public function edit($id)
    {
        $vendorId = Auth::id();
        
        // Verify the order item belongs to vendor's order
        $item = TblOrderItem::whereHas('order', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->findOrFail($id);
        
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $vendorId = Auth::id();
        
        $validator = Validator::make($request->all(), [
            'order_id'              => 'required|exists:tbl_orders,id',
            'product_category_id'   => 'nullable|exists:tbl_product_categories,id',
            'product_id'            => 'nullable|exists:tbl_products,id',
            'unit_price'            => 'nullable|integer',
            'quantity'              => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Verify the order item belongs to vendor's order
        $item = TblOrderItem::whereHas('order', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->findOrFail($id);
        
        $item->update($request->all());

        return response()->json(['status' => true, 'success' => 'Order Item updated successfully!']);
    }

    public function destroy($id)
    {
        $vendorId = Auth::id();
        
        // Verify the order item belongs to vendor's order
        $item = TblOrderItem::whereHas('order', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->findOrFail($id);
        
        $item->delete();
        return response()->json(['status' => true, 'success' => 'Order Item deleted successfully!']);
    }
}
