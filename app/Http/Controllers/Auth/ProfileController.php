<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ChangeImageRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\DeleteAccountRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use GdImage;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController
{
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile')
            ->with('status', 'Profile information updated');
    }

    public function verifyEmail(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return to_route('profile')
            ->with('status', 'Email verification sent');
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return to_route('profile')
            ->with('status', 'Password updated');
    }

    public function deleteAccount(DeleteAccountRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('index')
            ->with('status', 'Account deleted');
    }

    public function changeImage(ChangeImageRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
            $user->update(['profile_image' => null]);
        }

        if ($request->hasFile('image')) {
            /** @var UploadedFile $file */
            $file = $request->file('image');

            $in = $file->getMimeType() === 'image/jpeg' ? imagecreatefromjpeg($file) : imagecreatefrompng($file);
            if (!$in) {
                return to_route('profile')->withErrors(['image' => 'Cannot read image.']);
            }

            $stored = $this->resizeAndStore($file, $in, 200);
            if ($stored) {
                $user->update(['profile_image' => $stored]);
            }

            imagedestroy($in);
        }

        return to_route('profile')
            ->with('status', 'Image updated');
    }

    /** @param int<1,max> $size */
    private function resizeAndStore(UploadedFile $file, GdImage $image, int $size): string|false
    {
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        if (($imageWidth == $size) && ($imageHeight == $size)) {
            return Storage::putFile('profile_images', $file, 'public');
        }

        $copy = imagecreatetruecolor($size, $size);
        imagecopyresampled($copy, $image, 0, 0, 0, 0, $size, $size, $imageWidth, $imageHeight);

        $tempfile = tempnam(sys_get_temp_dir(), 'image');
        imagejpeg($copy, $tempfile);

        $result = Storage::putFile('profile_images', new File($tempfile), 'public');
        imagedestroy($copy);

        unlink($tempfile);

        return $result;
    }
}
