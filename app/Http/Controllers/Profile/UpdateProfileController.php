<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\UpdateProfileRequest;
use GdImage;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateProfileController
{
    public function __invoke(UpdateProfileRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->only(['name', 'email']));
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        if ($request->hasFile('image')) {
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
                $user->profile_image = null;
            }

            /** @var UploadedFile $file */
            $file = $request->file('image');

            $in = $file->getMimeType() === 'image/jpeg' ? imagecreatefromjpeg($file) : imagecreatefrompng($file);
            if (!$in) {
                return to_route('profile.index')
                    ->withErrors(['image' => 'Cannot read image.']);
            }

            $stored = $this->resizeAndStore($file, $in, 200);
            if ($stored) {
                $user->update(['profile_image' => $stored]);
            }

            imagedestroy($in);
        }

        return to_route('profile.index')->with(['status' => 'Profile updated successfully.']);
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
