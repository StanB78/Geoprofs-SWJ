<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_with_role_1_can_see_logout_and_verzuim_buttons()
    {
        $user = User::factory()->create([
            'rol' => 1,
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertDontSeeText('Melding');
        $response->assertSeeText('Log Out');
        $response->assertSeeText('verzuim');
    }

    public function test_user_with_role_2_can_see_melding_button()
    {
        $user = User::factory()->create([
            'rol' => 2,
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSeeText('Melding');
        $response->assertSeeText('verzuim');
        $response->assertSeeText('Log Out');
    }

    public function test_user_with_role_3_can_see_create_user_button()
    {
        $user = User::factory()->create([
            'rol' => 3,
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSeeText('Melding');
        $response->assertSeeText('verzuim');
        $response->assertSeeText('Create new User');
        $response->assertSeeText('Log Out');
    }
}
