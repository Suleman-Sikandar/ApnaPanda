<?php
namespace App\Services\Customer;

use App\Models\TblCart;
use App\Models\TblProduct;
use App\Models\TblProductCategory;
use App\Models\TblPaymentMethode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TblOrder; 
use App\Models\TblOrderItem; 
class CartService
{
    public function index()
    {
        $product = TblProduct::with(['category', 'vendor.users', 'images'])
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        // Fetch all categories for navigation
        $categories = TblProductCategory::all();

        $data               = [];
        $data['pageTitle']  = $product->name;
        $data['subTitle']   = 'Product Details';
        $data['product']    = $product;
        $data['categories'] = $categories;

        return view('customer.product.detail')->with($data);
    }

    public function store(Request $request, $id)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $product = TblProduct::findOrFail($id);

            $cart              = new TblCart();
            $cart->customer_id = Auth::id();
            $cart->product_id  = $id;
            $cart->quantity    = $request->quantity;
            if ($product->discount_amount) {
                $total          = $product->price - $product->discount_amount;
                $cart->price    = $total;
                $cart->subtotal = $request->quantity * $total;
            } else {
                $cart->price    = $product->price;
                $cart->subtotal = $request->quantity * $product->price;
            }

            $cart->save();

            return redirect()->back()->with('success', 'Your product has been added to the cart successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showCart()
    {
        $categories         = TblProductCategory::all();
        $data               = [];
        $data['pageTitle']  = 'Product Listing';
        $data['subTitle']   = 'Customer';
        $data['categories'] = $categories;
        $cart               = TblCart::with('product')->where('customer_id', Auth::id())->get();

        $deliveryCharge = $cart->contains(function ($item) {
            return $item->product->delivery_charge > 0;
        })
            ? $cart->firstWhere('product.delivery_charge', '>', 0)->product->delivery_charge
            : 0;

        return view('customer.product.cart', [
            'cart'           => $cart,
            'deliveryCharge' => $deliveryCharge,
        ])->with($data);
    }

    public function updateQty(Request $request)
    {
        $cart = TblCart::with('product')->find($request->id);

        if (! $cart) {
            return response()->json(['status' => false, 'message' => 'Cart item not found']);
        }

        $cart->quantity = $request->quantity;
        $product        = $cart->product;

        if ($product->discount_amount) {
            $total       = $product->price - $product->discount_amount;
            $cart->price = $total;
        } else {
            $cart->price = $product->price;
        }
        $cart->subtotal = $cart->quantity * $cart->price;
        $cart->save();

        return response()->json(['status' => true, 'message' => 'Quantity updated', 'cartItem' => $cart]);
    }

    public function destroy($id)
    {
        $cart=TblCart::find($id);
        if($cart)
        {
            $cart->delete();
            return response()->json([
                'status' => true,
                'success' => 'Your Cart Item Removed Successfully',
            ]);
        }
        return response()->json([
            'status' => false,
            'error' => 'Something Went Wrong',
        ]);
    }

    public function getCheckoutData()
    {
        $cart = TblCart::with('product')->where('customer_id', Auth::id())->get();

        $deliveryCharge = $cart->contains(function ($item) {
            return $item->product->delivery_charge > 0;
        })
            ? $cart->firstWhere('product.delivery_charge', '>', 0)->product->delivery_charge
            : 0;

        $itemTotal = $cart->sum('subtotal');
        $gstPercentage = 0.05; // 5% GST
        $gst = $itemTotal * $gstPercentage;
        $discount = 0; // To be implemented later if there are discounts

        $totalAmount = $itemTotal + $deliveryCharge + $gst - $discount;

        return [
            'cart'           => $cart,
            'deliveryCharge' => $deliveryCharge,
            'itemTotal'      => $itemTotal,
            // 'platformFee'    => $platformFee,
            'gst'            => $gst,
            'discount'       => $discount,
            'totalAmount'    => $totalAmount,
        ];
    }

   public function checkout($id)
    {
        $categories = TblProductCategory::all();
        $paymentMethods = TblPaymentMethode::orderBy('display_order', 'asc')->get();
        $data               = [];
        $data['pageTitle']  = 'CheckOut';
        $data['subTitle']   = 'Cart Checkout';
        $data['categories'] = $categories;
        $checkoutData       = $this->getCheckoutData();
        $data               = array_merge($data, $checkoutData);
        return view('customer.product.checkout', compact('paymentMethods'))->with($data);
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = TblCart::with('product')->where('customer_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            throw new \Exception('Your cart is empty.');
        }

        $checkoutData = $this->getCheckoutData();

        // Create the order
        $order = new TblOrder();
        $order->customer_id = $user->id;
        $order->vendor_id = $cartItems->first()->product->vendor_id;
        $order->order_status = 'pending'; 
        $order->payment_amount = $checkoutData['totalAmount'];
        $order->payment_method_id = $request->payment_method_id;
        $order->delivery_address = $request->delivery_address;
        $order->latitude = $request->latitude;
        $order->longitude = $request->longitude;
        $order->city = $request->city;
        $order->province = $request->province;
        $order->country = $request->country;
        $order->postal_code = $request->postal_code;
        $order->save();

        // Move cart items to order items
        foreach ($cartItems as $cartItem) {
            $orderItem = new TblOrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_category_id = $cartItem->product->category_id;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->unit_price = $cartItem->price;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->save();

            // Delete item from cart
            $cartItem->delete();
        }

        return ['status' => true, 'message' => 'Order placed successfully!', 'orderId' => $order->id];
    }

    public function order()
    {
        $categories = TblProductCategory::all();
        $orders = TblOrder::with(['orderItems.product.images', 'orderItems.product.vendor.users', 'paymentMethod'])
            ->where('customer_id', Auth::id())
            ->latest()->get();

        $completedOrders = TblOrder::where('customer_id', Auth::id())->where('order_status', 'completed')->count();
        $activeOrders = TblOrder::where('customer_id', Auth::id())->whereIn('order_status', ['pending', 'on-the-way', 'processing'])->count();
        $totalSpent = TblOrder::where('customer_id', Auth::id())->where('order_status', 'completed')->sum('payment_amount');

        $data = [
            'pageTitle' => 'My Orders',
            'subTitle' => 'Customer',
            'categories' => $categories,
            'orders' => $orders,
            'completedOrders' => $completedOrders,
            'activeOrders' => $activeOrders,
            'totalSpent' => $totalSpent,
        ];

        return view('customer.product.order')->with($data);
    }
}
