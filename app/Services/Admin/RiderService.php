<?php
namespace App\Services\Admin;

use App\Models\TblRiderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderService
{
    public function index()
    {
        $riders = TblRiderModel::with('users')->get();
        return view('admin.rider.listing', compact('riders'));
    }

    public function show($id)
    {
        $rider = TblRiderModel::with('users')->find($id);

        if (! $rider) {
            return view('admin.errors.404');
        }

        return view('admin.rider.profile', compact('rider'));
    }

    public function approve($id)
    {
        $rider = TblRiderModel::findOrFail($id);

        $rider->update([
            'status'               => 'approved',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
        ]);

        sendEmail(
            $rider->users->email,
            "Rider Account Approved",
            "Congratulations! Your rider account has been approved and is now active.",
            [
                'heading' => 'Approval Successful 🎉',
                'footer'  => 'Thank you for partnering with ' . config('app.name') . '.',
            ]
        );

        return response()->json(['message' => 'Rider approved successfully!']);
    }

    public function reject($id)
    {
        $rider = TblRiderModel::findOrFail($id);
        return view('admin.rider.reject_reason', compact('rider'));
    }

    public function rejectUpdate(Request $request, $id)
    {
        $request->validate(['rejection_reason' => 'required|string|max:1000']);

        $rider = TblRiderModel::findOrFail($id);

        $rider->update([
            'status'               => 'rejected',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
            'rejection_reason'     => $request->rejection_reason,
        ]);

        sendEmail(
            $rider->users->email,
            "Rider Request Rejected",
            $request->rejection_reason,
            [
                'heading' => 'Request Rejected ❌',
                'footer'  => 'You may apply again after resolving the issue.',
            ]
        );

        return redirect()->route('admin.riders')->with('success', 'Rider request rejected successfully!');
    }

    public function suspend($id)
    {
        $rider = TblRiderModel::findOrFail($id);
        return view('admin.rider.suspend_reason', compact('rider'));
    }

    public function suspendUpdate(Request $request, $id)
    {
        $request->validate(['rejection_reason' => 'required|string|max:1000']);

        $rider = TblRiderModel::findOrFail($id);
        $rider->update([
            'status'               => 'suspended',
            'approved_by_admin_id' => Auth::guard('admin')->id(),
            'status_updated_at'    => now(),
            'rejection_reason'     => $request->rejection_reason,
        ]);

        sendEmail(
            $rider->users->email,
            "Rider Account Suspended",
            $request->rejection_reason,
            [
                'heading' => 'Account Suspended ⚠️',
                'footer'  => 'Contact support for more details.',
            ]
        );

        return redirect()->route('admin.riders')->with('success', 'Rider suspended successfully!');
    }

    public function pendingApproval()
    {
        $riders = TblRiderModel::with('users')
            ->where('status', '!=', 'approved')
            ->get();

        return view('admin.rider.pending_approval', compact('riders'));
    }
}

