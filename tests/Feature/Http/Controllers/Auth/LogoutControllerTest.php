<?php

use App\Models\User;

it('logs out successfully', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('logout'))
        ->assertRedirectToRoute('index');

    $this->assertGuest();
});
