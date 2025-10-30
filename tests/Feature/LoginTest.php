<?php

it('has login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('user login', function () {
    // Create a user named "test" with rol = 3
    $user = User::create([
        'name' => 'test',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'rol' => 3,
        'leaveToken' => 2,
    ]);

    // Attempt to log in with valid credentials
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    // Verify authentication worked
    $this->assertAuthenticatedAs($user);

    // Verify redirect (adjust if your app redirects elsewhere)
    $response->assertRedirect(route('dashboard', absolute: false));
});
