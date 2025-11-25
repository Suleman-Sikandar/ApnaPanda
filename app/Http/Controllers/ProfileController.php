<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display profile edit page.
     */
    public function edit($id): View
    {
        $users = User::findOrFail($id);

        return view('customer.profile', compact('users'));
    }

    /**
     * Update profile and handle image upload.
     */
    public function update(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());
        if ($request->filled('croppedImage')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $base64image = $request->croppedImage;
            $image_parts = explode(";base64,", $base64image);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'profile_' . time() . '.png';
            $filePath = 'profile_images/' . $fileName;
            Storage::disk('public')->put($filePath, $image_base64);

            $user->avatar = $filePath;
        }

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $fileName = 'profile_' . time() . '.' . $request->file('profile_image')->extension();
            $filePath = $request->file('profile_image')->storeAs('profile_images', $fileName, 'public');

            $user->profile_image = $filePath;
        }

        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }
        $user->phone = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->save();

        return Redirect::back()->with('success', 'Profile updated successfully');
    }

    /**
     * Delete user account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
