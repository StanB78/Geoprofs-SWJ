<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_allows_a_user_to_log_in()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'rol' => 3,
            'leaveToken' => 2,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }
}
