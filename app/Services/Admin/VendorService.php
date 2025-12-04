<?php
namespace App\Services\Admin;

use App\Models\TblVendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (! $vendor) {
            return view('admin.errors.404');
        }

        return view('admin.vendor.profile', compact('vendor'));
    }

    public function approve($id)
    {
        $vendor = TblVendorModel::findOrFail($id);

        $vendor->update([
            'status'               => 'approved',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
        ]);

        sendEmail(
            $vendor->users->email,
            "Vendor Account Approved",
            "Congratulations! Your vendor account has been approved and is now active.",
            [
                'heading' => 'Approval Successful 🎉',
                'footer'  => 'Thank you for choosing ' . config('app.name') . '.',
            ]
        );

        return response()->json(['message' => 'Vendor approved successfully!']);
    }

    public function reject($id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        return view('admin.vendor.reject_reason', compact('vendor'));
    }

    public function rejectUpdate(Request $request, $id)
    {
        $vendor = TblVendorModel::findOrFail($id);

        $vendor->update([
            'status'               => 'rejected',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
            'rejection_reason'     => $request->rejection_reason,
        ]);

        sendEmail(
            $vendor->users->email,
            "Vendor Request Rejected",
            $request->rejection_reason,
            [
                'heading' => 'Request Rejected ❌',
                'footer'  => 'You may apply again after resolving the issue.',
            ]
        );

        return redirect()->route('admin.vendors')->with('success', 'Vendor request rejected successfully!');
    }

    public function suspend($id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        return view('admin.vendor.suspend_reason', compact('vendor'));
    }

    public function suspendUpdate(Request $request, $id)
    {
        $vendor = TblVendorModel::findOrFail($id);
        $vendor->update([
            'status'               => 'suspended',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
            'rejection_reason'     => $request->rejection_reason,
        ]);
        sendEmail(
            $vendor->users->email,
            "Vendor Account Suspended",
            $request->rejection_reason,
            [
                'heading' => 'Account Suspended ⚠️',
                'footer'  => 'Contact support for more details.',
            ]
        );

        return redirect()->route('admin.vendors')->with('success', 'Vendor suspended successfully!');
    }
    public function pendingApproval()
    {
        $vendors = TblVendorModel::with('users')
            ->where('status', '!=', 'approved')
            ->get();

        return view('admin.vendor.pending_approval', compact('vendors'));
    }
}
