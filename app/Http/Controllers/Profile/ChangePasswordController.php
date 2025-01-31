<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController
{
    public function __invoke(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return to_route('profile.index')->with(['status' => 'Password updated successfully.']);
    }
}
