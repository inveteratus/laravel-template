<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

it('can change password', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->from(route('profile.index'))
        ->post(route('profile.change-password'), ['current' => 'password', 'password' => 'something-else'])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile.index')
        ->assertSessionHas('status');

    $this->assertTrue(Hash::check('something-else', $user->fresh()->password));
});
