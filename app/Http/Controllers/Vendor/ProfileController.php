<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\BusinessInformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use App\Services\Vendor\VendorProfile;
class ProfileController extends Controller
{
    public function __construct(VendorProfile $vendorProfile){
        $this->vendorProfile=$vendorProfile;
    }
 
    public function vendor_profile($id)
    {
        return $this->vendorProfile->vendor_profile($id);
    }

    public function storeVendorDetail(ProfileUpdateRequest $request, $id)
    {
        return $this->vendorProfile->storeVendorDetail($request,$id);
    }

    private function checkStep($id, $requiredStep)
    {
        $vendor = \App\Models\TblVendorModel::where('user_id', $id)->first();
        if (!$vendor) {
            // If no vendor record, only step 1 (Profile) and 2 (Business Info - creation) are allowed.
            // But Profile is User model, Business Info creates Vendor.
            // So if accessing business info, it's fine.
            if ($requiredStep > 2) {
                return redirect()->route('vendor.business.info', $id)->with('error', 'Please complete business information first.');
            }
            return null;
        }

        if ($vendor->current_step < $requiredStep) {
            $routes = [
                1 => 'vendor.profile',
                2 => 'vendor.business.info',
                3 => 'vendor.documents',
                4 => 'vendor.bank',
                5 => 'vendor.address',
                6 => 'vendor.face.verification',
            ];
            $route = $routes[$vendor->current_step] ?? 'vendor.profile';
            return redirect()->route($route, $id)->with('error', 'Please complete the previous step first.');
        }
        return null;
    }
    
    public function businessinfor($id)
    {
        if ($redirect = $this->checkStep($id, 2)) return $redirect;
        return $this->vendorProfile->businessinfor($id);
    }
    
    public function businessinfoStore(BusinessInformationRequest $request, $id)
    {
        return $this->vendorProfile->businessinfoStore( $request, $id);
    }

    public function documents($id)
    {
        return $this->vendorProfile->documents($id);
    }

    public function storeDocuments(Request $request, $id)
    {
        // We need to validate here or in service, but controller is better for injection
        // However, to keep pattern consistent with existing code, I'll delegate to service
        // But I need to inject the custom request. 
        // Since the method signature in service might need the request, I'll resolve it there or pass it.
        // Let's use the custom request here.
        $request = app(\App\Http\Requests\VendorDocumentRequest::class);
        return $this->vendorProfile->storeDocuments($request, $id);
    }

    public function bank($id)
    {
        return $this->vendorProfile->bank($id);
    }

    public function storeBank(Request $request, $id)
    {
        $request = app(\App\Http\Requests\VendorBankRequest::class);
        return $this->vendorProfile->storeBank($request, $id);
    }

    public function address($id)
    {
        return $this->vendorProfile->address($id);
    }

    public function storeAddress(Request $request, $id)
    {
        $request = app(\App\Http\Requests\VendorAddressRequest::class);
        return $this->vendorProfile->storeAddress($request, $id);
    }

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
        return $this->vendorProfile->faceVerification($id);
    }

    public function processFaceVerification(Request $request, $id)
    {
        return $this->vendorProfile->processFaceVerification($request, $id);
    }
}
