<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

it('renders the page', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertViewIs('auth.register');
});

it('registers a new user', function () {
    Notification::fake();

    $this->post(route('register'), [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
        ])
        ->assertRedirectToRoute('home');

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

    Notification::assertSentTo(
        notifiable:User::query()->where('email', 'test@example.com')->first(),
        notification:VerifyEmail::class
    );
});

it('redirects if already authenticated', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('register'))
        ->assertRedirectToRoute('home');
});
