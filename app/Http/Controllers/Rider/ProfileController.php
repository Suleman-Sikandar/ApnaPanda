<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiderAddressRequest;
use App\Http\Requests\RiderDocumentRequest;
use App\Http\Requests\RiderProfileRequest;
use App\Http\Requests\RiderVehicleRequest;
use App\Models\TblRiderModel;
use App\Services\Rider\RiderProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $riderProfile;

    public function __construct(RiderProfile $riderProfile)
    {
        $this->riderProfile = $riderProfile;
    }

    private function checkStep($requiredStep)
    {
        $userId = Auth::id();

        if (! $userId) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $rider = TblRiderModel::where('user_id', $userId)->first();

        if (! $rider && $requiredStep > 2) {
            return redirect()->route('rider.profile', $userId)
                ->with('error', 'Please complete your profile first.');
        }

        if ($rider && $rider->current_step < $requiredStep) {
            $routes = [
                1 => 'rider.profile',
                2 => 'rider.vehicle',
                3 => 'rider.documents',
                4 => 'rider.address',
                5 => 'rider.face.verification',
            ];

            $redirectRoute = $routes[$rider->current_step] ?? 'rider.profile';

            if ($redirectRoute !== \Route::currentRouteName()) {
                return redirect()->route($redirectRoute, $userId)
                    ->with('error', 'Please complete previous steps first.');
            }
        }

        return null;
    }

    public function profile($id)
    {
        if ($redirect = $this->checkStep(1)) return $redirect;
        return $this->riderProfile->profile($id);
    }

    public function storeProfile(RiderProfileRequest $request, $id)
    {
        if ($redirect = $this->checkStep(1)) return $redirect;
        return $this->riderProfile->storeProfile($request, $id);
    }

    public function vehicle($id)
    {
        if ($redirect = $this->checkStep(2)) return $redirect;
        return $this->riderProfile->vehicle($id);
    }

    public function storeVehicle(RiderVehicleRequest $request, $id)
    {
        if ($redirect = $this->checkStep(2)) return $redirect;
        return $this->riderProfile->storeVehicle($request, $id);
    }

    public function documents($id)
    {
        if ($redirect = $this->checkStep(3)) return $redirect;
        return $this->riderProfile->documents($id);
    }

    public function storeDocuments(RiderDocumentRequest $request, $id)
    {
        if ($redirect = $this->checkStep(3)) return $redirect;
        return $this->riderProfile->storeDocuments($request, $id);
    }

    public function address($id)
    {
        if ($redirect = $this->checkStep(4)) return $redirect;
        return $this->riderProfile->address($id);
    }

    public function storeAddress(RiderAddressRequest $request, $id)
    {
        if ($redirect = $this->checkStep(4)) return $redirect;
        return $this->riderProfile->storeAddress($request, $id);
    }

    public function faceVerification($id)
    {
        if ($redirect = $this->checkStep(5)) return $redirect;
        return $this->riderProfile->faceVerification($id);
    }

    public function processFaceVerification(Request $request, $id)
    {
        if ($redirect = $this->checkStep(5)) return $redirect;
        return $this->riderProfile->processFaceVerification($request, $id);
    }

    public function security($id)
    {
        return $this->riderProfile->security($id);
    }

    public function updatePassword(Request $request, $id)
    {
        return $this->riderProfile->updatePassword($request, $id);
    }
}

