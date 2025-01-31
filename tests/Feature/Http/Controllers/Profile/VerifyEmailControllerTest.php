<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

it('can verify email', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();
    $this->actingAs($user)
        ->from(route('profile.index'))
        ->post(route('profile.verify-email'))
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile.index');

    Notification::assertSentTo($user, VerifyEmail::class);
});
