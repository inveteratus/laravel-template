<?php

use App\Models\User;

it('can delete account', function () {
    $user = User::factory()->create(['profile_image' => 'profile_images/sample.png']);
    $this->actingAs($user)
        ->from(route('profile.index'))
        ->delete(route('profile.delete-account'), ['password' => 'password'])
        ->assertSessionDoesntHaveErrors()
         ->assertRedirectToRoute('index')
        ->assertSessionHas('status');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});
