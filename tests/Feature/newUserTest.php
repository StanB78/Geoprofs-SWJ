<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_register_page()
    {
        $admin = User::factory()->create([
            'email' => 'amira70@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);

        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('name="password_confirmation"', false);
        $response->assertSee('name="rol"', false);
    }

    public function test_admin_can_create_new_user()
    {
        $admin = User::factory()->create([
            'email' => 'amira70@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $email = 'testuser_' . time() . '@example.com';

        $response = $this->post('/register', [
            'name' => 'Test Werknemer',
            'email' => $email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'rol' => 1,
        ]);

        $response->assertRedirect('/register');

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => 'Test Werknemer',
            'role' => 1,
        ]);
    }
}
