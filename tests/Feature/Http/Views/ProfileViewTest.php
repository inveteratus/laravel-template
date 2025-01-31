<?php

use App\Models\User;

it('renders the page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('profile.index'))
        ->assertOk()
        ->assertViewIs('profile');
});
