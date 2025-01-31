<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\DeleteAccountRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteAccountController
{
    public function __invoke(DeleteAccountRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('index')->with(['status' => 'Account successfully deleted.']);
    }
}
