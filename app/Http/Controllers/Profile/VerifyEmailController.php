<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return to_route('profile.index')->with(['status' => 'Email verification sent.']);
    }
}
