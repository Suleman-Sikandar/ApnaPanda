<?php
namespace App\Services\Rider;

use App\Http\Requests\RiderAddressRequest;
use App\Http\Requests\RiderDocumentRequest;
use App\Http\Requests\RiderProfileRequest;
use App\Http\Requests\RiderVehicleRequest;
use App\Models\TblRiderModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RiderProfile
{
    private function getRiderWithDetails($id)
    {
        $user = User::with('riderDetail')->find($id);

        if (! $user) {
            abort(404, 'User not found');
        }

        if (! isset($user->id)) {
            $user->id = $id;
        }

        if ($user->riderDetail) {
            foreach ($user->riderDetail->getAttributes() as $key => $value) {
                if (! isset($user->$key)) {
                    $user->$key = $value;
                }
            }
        }

        return $user;
    }

    public function profile($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'profile';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function storeProfile(RiderProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());

        if ($request->filled('croppedImage')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $imageParts  = explode(";base64,", $request->croppedImage);
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName    = 'rider_profile_' . time() . '.png';
            $filePath    = 'rider/profile_images/' . $fileName;
            Storage::disk('public')->put($filePath, $imageBase64);
            $user->profile_image = $filePath;
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $fileName = 'rider_profile_' . time() . '.' . $request->file('profile_image')->extension();
            $filePath = $request->file('profile_image')->storeAs('rider/profile_images', $fileName, 'public');

            $user->profile_image = $filePath;
        }

        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->phone         = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender        = $request->gender;
        $user->save();

        $rider = TblRiderModel::where('user_id', $id)->first();
        if (! $rider) {
            $rider = TblRiderModel::create([
                'user_id'           => $id,
                'phone'             => $request->phone,
                'alternative_phone' => $request->alternative_phone,
                'current_step'      => 2,
            ]);
        } else {
            $rider->phone             = $request->phone;
            $rider->alternative_phone = $request->alternative_phone;
            if ($rider->current_step < 2) {
                $rider->current_step = 2;
            }
            $rider->save();
        }

        return redirect()->route('rider.vehicle', $id)->with('success', 'Profile updated successfully');
    }

    public function vehicle($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'vehicle';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function storeVehicle(RiderVehicleRequest $request, $id)
    {
        $data = $request->validated();
        $rider = TblRiderModel::where('user_id', $id)->first();

        if (! $rider) {
            $data['user_id'] = $id;
            $data['current_step'] = 3;
            TblRiderModel::create($data);
        } else {
            $rider->update($data);
            if ($rider->current_step < 3) {
                $rider->update(['current_step' => 3]);
            }
        }

        return redirect()->route('rider.documents', $id)->with('success', 'Vehicle information saved');
    }

    public function documents($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'documents';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function storeDocuments(RiderDocumentRequest $request, $id)
    {
        $data = $request->validated();
        $rider = TblRiderModel::where('user_id', $id)->first();

        if (! $rider) {
            $rider = TblRiderModel::create(['user_id' => $id]);
        }

        $files = ['license_front', 'license_back', 'national_id_front', 'national_id_back'];
        $resetVerification = false;

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                if ($rider->$file && Storage::disk('public')->exists($rider->$file)) {
                    Storage::disk('public')->delete($rider->$file);
                }
                $data[$file] = $request->file($file)->store('rider/documents', 'public');
                $resetVerification = true;
            }
        }

        if ($resetVerification) {
            $data['is_face_verified'] = false;
            if ($rider->current_step >= 6) {
                $data['current_step'] = 5;
            }
        }

        $rider->update($data);
        if ($rider->current_step < 4) {
            $rider->update(['current_step' => 4]);
        }

        return redirect()->route('rider.address', $id)->with('success', 'Documents uploaded successfully');
    }

    public function address($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'address';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function storeAddress(RiderAddressRequest $request, $id)
    {
        $data = $request->validated();
        $rider = TblRiderModel::where('user_id', $id)->first();

        if (! $rider) {
            $data['user_id'] = $id;
            $data['current_step'] = 5;
            TblRiderModel::create($data);
        } else {
            $rider->update($data);
            if ($rider->current_step < 5) {
                $rider->update(['current_step' => 5]);
            }
        }

        return redirect()->route('rider.face.verification', $id)->with('success', 'Address saved successfully');
    }

    public function faceVerification($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'face_verification';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function processFaceVerification($request, $id)
    {
        $rider = TblRiderModel::where('user_id', $id)->firstOrFail();

        $rider->update([
            'is_face_verified' => true,
            'current_step'     => 6,
        ]);

        return response()->json(['success' => true, 'message' => 'Face verified. Await admin approval.']);
    }

    public function security($id)
    {
        $rider = $this->getRiderWithDetails($id);
        $activeSection = 'security';
        return view('rider.profile.index', compact('rider', 'activeSection'));
    }

    public function updatePassword($request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('rider.security', $id)->with('success', 'Password updated successfully!');
    }
}

