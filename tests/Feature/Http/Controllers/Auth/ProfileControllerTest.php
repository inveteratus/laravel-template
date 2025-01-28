<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

it('renders the page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('profile'))
        ->assertOk()
        ->assertViewIs('auth.profile');
});

it('can update basic enformation', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->from(route('profile'))
        ->post(route('update-profile'), ['name' => 'John Doe', 'email' => 'johndoe@example.com'])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile');
    $this->assertDatabaseHas('users', [
        'id' => $user->refresh()->id,
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'email_verified_at' => null,
    ]);
});

it('can change password', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->from(route('profile'))
        ->post(route('change-password'), ['current' => 'password', 'password' => 'something-else'])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile');

    $this->assertTrue(Hash::check('something-else', $user->fresh()->password));
});

it('can delete account', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->from(route('profile'))
        ->delete(route('delete-account'), ['password' => 'password'])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('index');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('can verify email', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();
    $this->actingAs($user)
        ->from(route('profile'))
        ->post(route('verify-email'))
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('profile');

    Notification::assertSentTo($user, VerifyEmail::class);
});
