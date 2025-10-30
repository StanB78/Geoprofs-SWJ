<?php

it('has login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('allows a user to log in', function () {
    // Create user
    $user = User::factory()->create([
        'password' => bcrypt('password'),
        'rol' => 3,
        'leaveToken' => 2,
    ]);

    // Attempt login
    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('dashboard'));


    //assertAuthenticatedAs
    $this->assertAuthenticatedAs($user);
});

