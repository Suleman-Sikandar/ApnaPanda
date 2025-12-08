<?php
namespace App\Services\Admin;

use App\Models\TblOrderItem;
use App\Models\TblOrder;
use App\Models\TblProductCategory;
use App\Models\TblProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemService
{
    public function index()
    {
        $orderItems = TblOrderItem::with(['order', 'productCategory', 'product'])->orderBy('id', 'desc')->get();
        // Dropdown Data
        $orders = TblOrder::all();
        $categories = TblProductCategory::all();
        $products = TblProduct::all();

        return view('admin.order_item.listing', compact('orderItems', 'orders', 'categories', 'products'));
    }

    public function store(Request $request)
    {
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

        TblOrderItem::create($request->all());

        return response()->json(['status' => true, 'success' => 'Order Item created successfully!']);
    }

    public function edit($id)
    {
        $item = TblOrderItem::findOrFail($id);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
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

        $item = TblOrderItem::findOrFail($id);
        $item->update($request->all());

        return response()->json(['status' => true, 'success' => 'Order Item updated successfully!']);
    }

    public function destroy($id)
    {
        $item = TblOrderItem::findOrFail($id);
        $item->delete();
        return response()->json(['status' => true, 'success' => 'Order Item deleted successfully!']);
    }
}
