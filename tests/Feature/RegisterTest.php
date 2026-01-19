<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_access_register()
    {
        $response = $this->get('/register');
        $response->assertStatus(403); // geen toegang
    }

    public function test_sum_of_two_numbers()
    {
        $this->assertEquals(5, 3 + 2);
    }

    public function test_user_roles_access_to_register()
    {
        $roles = [
            1 => 403,
            2 => 403,
            3 => 200,
        ];

        foreach ($roles as $role => $expectedStatus) {
            $user = User::factory()->create(['rol' => $role]);
            $this->actingAs($user);

            $response = $this->get('/register');

            $response->assertStatus($expectedStatus);

            auth()->logout();
        }
    }
}
