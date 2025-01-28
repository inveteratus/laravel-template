<?php

use App\Models\User;

it('renders the page', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertViewIs('auth.login');
});

it('logs in successfully', function () {
    $user = User::factory()->create();

    $this->post(route('login'), ['email' => $user->email, 'password' => 'password'])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('home');

    $this->assertAuthenticatedAs($user);
});

it('doesn\'t login with bad credentials', function () {
    $user = User::factory()->create();

    $this->from(route('login'))
        ->post(route('login'), ['email' => $user->email, 'password' => 'incorrect'])
        ->assertSessionHasErrors(['email' => 'Invalid credentials.'])
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

it('redirects if already authenticated', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirectToRoute('home');
});
