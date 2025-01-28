<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

it('renders the page', function () {
    $this->get(route('forgot-password'))
        ->assertOk()
        ->assertViewIs('auth.forgot-password');
});

it('sends an email to the user', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->from(route('forgot-password'))
        ->post(route('forgot-password'), ['email' => $user->email])
        ->assertRedirectToRoute('forgot-password');

    Notification::assertSentTo($user, ResetPassword::class);
});
