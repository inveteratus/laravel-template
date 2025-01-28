<?php

use App\Models\User;

it('renders the page', function () {
    $this->get(route('index'))
        ->assertOk()
        ->assertViewIs('index');
});

it('redirects if already authenticated', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('index'))
        ->assertRedirectToRoute('home');
});
