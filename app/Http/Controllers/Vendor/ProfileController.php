<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\BusinessInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Vendor\VendorProfile;
use App\Models\TblVendorModel;

class ProfileController extends Controller
{
    protected $vendorProfile;

    public function __construct(VendorProfile $vendorProfile)
    {
        $this->vendorProfile = $vendorProfile;
    }

    /**
     * Step check method
     * Prevents users from accessing routes of uncompleted steps
     */
    private function checkStep($requiredStep)
    {
        $userId = Auth::id();
        
        // If not authenticated, redirect to login
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }
        
        $vendor = TblVendorModel::where('user_id', $userId)->first();

        if (!$vendor && $requiredStep > 2) {
            return redirect()->route('vendor.profile', $userId)
                ->with('error', 'Please complete your profile first.');
        }

        if ($vendor && $vendor->current_step < $requiredStep) {
            $routes = [
                1 => 'vendor.profile',
                2 => 'vendor.business.info',
                3 => 'vendor.documents',
                4 => 'vendor.bank',
                5 => 'vendor.address',
                6 => 'vendor.face.verification',
            ];

            $redirectRoute = $routes[$vendor->current_step] ?? 'vendor.profile';

            if ($redirectRoute !== \Route::currentRouteName()) {
                return redirect()->route($redirectRoute, $userId)
                    ->with('error', 'Please complete previous steps first.');
            }
        }

        return null;
    }

    // ===================== Step 1 =====================
    public function vendor_profile($id)
    {
        if ($redirect = $this->checkStep(1)) return $redirect;

        return $this->vendorProfile->vendor_profile($id);
    }

    public function storeVendorDetail(ProfileUpdateRequest $request, $id)
    {
        if ($redirect = $this->checkStep(1)) return $redirect;

        return $this->vendorProfile->storeVendorDetail($request, $id);
    }

    // ===================== Step 2 =====================
    public function businessinfor($id)
    {
        if ($redirect = $this->checkStep(2)) return $redirect;

        return $this->vendorProfile->businessinfor($id);
    }

    public function businessinfoStore(BusinessInformationRequest $request, $id)
    {
        if ($redirect = $this->checkStep(2)) return $redirect;

        return $this->vendorProfile->businessinfoStore($request, $id);
    }

    // ===================== Step 3 =====================
    public function documents($id)
    {
        if ($redirect = $this->checkStep(3)) return $redirect;

        return $this->vendorProfile->documents($id);
    }

    public function storeDocuments(Request $request, $id)
    {
        if ($redirect = $this->checkStep(3)) return $redirect;

        $request = app(\App\Http\Requests\VendorDocumentRequest::class);
        return $this->vendorProfile->storeDocuments($request, $id);
    }

    // ===================== Step 4 =====================
    public function bank($id)
    {
        if ($redirect = $this->checkStep(4)) return $redirect;

        return $this->vendorProfile->bank($id);
    }

    public function storeBank(Request $request, $id)
    {
        if ($redirect = $this->checkStep(4)) return $redirect;

        $request = app(\App\Http\Requests\VendorBankRequest::class);
        return $this->vendorProfile->storeBank($request, $id);
    }

    // ===================== Step 5 =====================
    public function address($id)
    {
        if ($redirect = $this->checkStep(5)) return $redirect;

        return $this->vendorProfile->address($id);
    }

    public function storeAddress(Request $request, $id)
    {
        if ($redirect = $this->checkStep(5)) return $redirect;

        $request = app(\App\Http\Requests\VendorAddressRequest::class);
        return $this->vendorProfile->storeAddress($request, $id);
    }

    // ===================== Step 6 =====================
    public function security($id)
    {

        return $this->vendorProfile->security($id);
    }

    public function updatePassword(Request $request, $id)
    {

        return $this->vendorProfile->updatePassword($request, $id);
    }

    public function faceVerification($id)
    {
        if ($redirect = $this->checkStep(6)) return $redirect;

        return $this->vendorProfile->faceVerification($id);
    }

    public function processFaceVerification(Request $request, $id)
    {
        if ($redirect = $this->checkStep(6)) return $redirect;

        return $this->vendorProfile->processFaceVerification($request, $id);
    }
}
