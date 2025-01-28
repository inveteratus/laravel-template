<?php


use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

it('renders the page', function () {
    $this->get(route('password.reset'))
        ->assertOk()
        ->assertViewIs('auth.reset-password');
});

it('resets the password successfully', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post(route('forgot-password'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $this->post(route('password.reset.store'), [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'something-else',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('login'));

        return true;
    });

    $this->assertTrue(Hash::check('something-else', $user->refresh()->password));
});
