<?php

use App\Models\User;

it('renders the page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('home'))
        ->assertOk()
        ->assertViewIs('home');
});
