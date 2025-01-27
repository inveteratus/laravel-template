<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\DeleteAccountRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController
{
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile');
    }

    public function verifyEmail(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return to_route('profile');
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return to_route('profile');
    }

    public function deleteAccount(DeleteAccountRequest $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('index');
    }
}
