<?php
namespace App\Services\Vendor;

use App\Models\TblOrder;
use App\Models\TblProduct;
use App\Models\TblOrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function index()
    {
        $vendorId = Auth::id();
        $orders = TblOrder::where('vendor_id', $vendorId)->count();
        $totalRevenue = TblOrder::where('vendor_id', $vendorId)->sum('payment_amount');
        $total = 'PKR ' . number_format($totalRevenue);
        $products = TblProduct::where('vendor_id', $vendorId)->count();
        $rating = '4.8';
        $pendingOrders = TblOrder::where('vendor_id', $vendorId)
                            ->where('order_status', 'pending')
                            ->count();
        
        $completedOrders = TblOrder::where('vendor_id', $vendorId)
                                ->where('order_status', 'completed')
                                ->count();
        
        $recentOrders = TblOrder::with(['customer', 'paymentMethod'])
                            ->where('vendor_id', $vendorId)
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
        
        $topProducts = DB::table('tbl_products')
                            ->leftJoin('tbl_order_items', 'tbl_products.id', '=', 'tbl_order_items.product_id')
                            ->select('tbl_products.id', 'tbl_products.name', 'tbl_products.price')
                            ->selectRaw('COALESCE(SUM(tbl_order_items.quantity), 0) as total_sold')
                            ->where('tbl_products.vendor_id', $vendorId)
                            ->groupBy('tbl_products.id', 'tbl_products.name', 'tbl_products.price')
                            ->orderByDesc('total_sold')
                            ->limit(5)
                            ->get();
        
        $monthlyRevenue = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $revenue = TblOrder::where('vendor_id', $vendorId)
                        ->whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month)
                        ->sum('payment_amount');
            $monthlyRevenue->push([
                'month' => $month->format('M'),
                'revenue' => $revenue
            ]);
        }
        
        $data = [
            'pageTitle' => 'Dashboard',
            'subTitle' => 'Vendor',
            'orders' => $orders,
            'total' => $total,
            'products' => $products,
            'rating' => $rating,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'monthlyRevenue' => $monthlyRevenue,
        ];
        
        return view('vendor.dashboard')->with($data);
    }
}