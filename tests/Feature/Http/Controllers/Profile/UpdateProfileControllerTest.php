<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('can update profile', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->from(route('profile.index'))
        ->post(route('profile.update-profile'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'image' => UploadedFile::fake()->image('sample.png', 200, 200),
        ])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile.index');

    $this->assertDatabaseHas('users', [
        'id' => $user->refresh()->id,
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'email_verified_at' => null,
    ]);
    Storage::assertExists($user->fresh()->profile_image);

    $this->actingAs($user)
        ->from(route('profile.index'))
        ->post(route('profile.update-profile'), [
            'name' => $user->name,
            'email' => $user->email,
            'image' => UploadedFile::fake()->image('sample.jpeg', 400, 400),
        ])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile.index');

    Storage::assertExists($user->fresh()->profile_image);
});
