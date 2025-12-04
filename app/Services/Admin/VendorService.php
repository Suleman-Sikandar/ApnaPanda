<?php
namespace App\Services\Admin;

use App\Models\TblVendorModel;
use Auth;
use Illuminate\Http\Request;

class VendorService
{
    public function index()
    {
        $vendors = TblVendorModel::with('users')->get();
        return view('admin.vendor.listing', compact('vendors'));
    }
    public function show($id)
    {
        $vendor = TblVendorModel::with('users')->find($id);
        if ($vendor) {
            return view('admin.vendor.profile', compact('vendor'));
        } else {
            return view('admin.errors.404');
        }
    }

    public function approve($id)
    {
        $vendor                       = TblVendorModel::findOrFail($id);
        $vendor->status               = 'approved';
        $vendor->approved_by_admin_id = Auth::guard('admin')->id();
        $vendor->status_updated_at    = now();
        $vendor->save();

        return response()->json([
            'message' => 'Vendor approved successfully!',
        ]);
    }

    public function reject($id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        if ($vendor) {
            return view('admin.vendor.reject_reason', compact('vendor'));
        } else {
            return view('admin.errors.404');
        }
    }

    public function rejectUpdate(Request $request, $id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        if ($vendor) {
            $vendor->status               = 'rejected';
            $vendor->approved_by_admin_id = Auth::guard('admin')->id();
            $vendor->status_updated_at    = now();
            $vendor->rejection_reason     = $request->rejection_reason;
            $vendor->save();
            return redirect()->to('admin/vendors')->with('success', "The Vendor request Rejected SuccessFully");
        }

    }

    public function suspend($id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        if ($vendor) {
            return view('admin.vendor.suspend_reason', compact('vendor'));
        } else {
            return view('admin.errors.404');
        }
    }

    public function suspendUpdate(Request $request, $id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        if ($vendor) {
            $vendor->status               = 'suspended';
            $vendor->approved_by_admin_id = Auth::guard('admin')->id();
            $vendor->status_updated_at    = now();
            $vendor->rejection_reason     = $request->rejection_reason;
            $vendor->save();
            return redirect()->to('admin/vendors')->with('success', "The Vendor request Suspended SuccessFully");
        }

    }

    public function pendingApproval()
    {
        $vendors = TblVendorModel::with('users')
            ->where('status', '!=', 'approved')
            ->get();

        return view('admin.vendor.pending_approval', compact('vendors'));
    }

}
