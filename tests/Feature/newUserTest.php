<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('TC-011 – navigates to register page via Create New User button', function () {
    // Create an admin user
    $admin = User::factory()->create([
        'email' => 'amira70@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin', // adjust according to your app
    ]);

    // Act as admin
    $this->actingAs($admin);

    // Visit dashboard
    $response = $this->get('/dashboard');
    $response->assertStatus(200);

    // Click Create New User link (simulate visiting)
    $response = $this->get('/register');
    $response->assertStatus(200);

    // Assert form fields are present
    $response->assertSee('name="name"');
    $response->assertSee('name="email"');
    $response->assertSee('name="password"');
    $response->assertSee('name="password_confirmation"');
    $response->assertSee('name="rol"');
});

it('TC-011 – creates a new user account with selected authority', function () {
    $admin = User::factory()->create([
        'email' => 'amira70@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    $this->actingAs($admin);

    // Post to register route
    $email = 'testuser_' . time() . '@example.com';

    $response = $this->post('/register', [
        'name' => 'Test Werknemer',
        'email' => $email,
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'rol' => 1,
    ]);

    // Verify redirect (Laravel default)
    $response->assertRedirect('/register');

    // Verify user exists in database
    $this->assertDatabaseHas('users', [
        'email' => $email,
        'name' => 'Test Werknemer',
        'role' => 1,
    ]);
});
