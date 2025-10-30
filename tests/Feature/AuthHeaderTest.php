<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthHeaderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest should see 'Niet' and 'Log in' but not any auth-only buttons.
     */
    public function test_guest_sees_login_and_not_logout()
    {
        $response = $this->get('/'); // Renders welcome.blade.php

        $response->assertStatus(200)
            ->assertSee('Logged in as:')
            ->assertSee('Niet toegestaan')
            ->assertSee('Log in')
            ->assertDontSee('Log out')
            ->assertDontSee('Create new User')
            ->assertDontSee('Melding')
            ->assertSee('verzuim'); // everyone sees verzuim link
    }

    /**
     * Role 1 user sees only verzuim and logout.
     */
    public function test_user_with_role_1_sees_verzuim_and_logout()
    {
        $user = User::factory()->create([
            'role_id' => 1,
            'name' => 'Jan',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
            ->assertSee('Jan')
            ->assertSee('verzuim')
            ->assertSee('Log out')
            ->assertDontSee('Create new User')
            ->assertDontSee('Melding');
    }

    /**
     * Role 2 user sees verzuim, melding, and logout.
     */
    public function test_user_with_role_2_sees_melding_button()
    {
        $user = User::factory()->create([
            'role_id' => 2,
            'name' => 'Bob',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
            ->assertSee('Bob')
            ->assertSee('verzuim')
            ->assertSee('Melding')
            ->assertSee('Log out')
            ->assertDontSee('Create new User');
    }

    /**
     * Role 3 user sees verzuim, create user, and logout.
     */
    public function test_user_with_role_3_sees_create_user_button()
    {
        $user = User::factory()->create([
            'role_id' => 3,
            'name' => 'Piet',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
            ->assertSee('Piet')
            ->assertSee('verzuim')
            ->assertSee('Create new User')
            ->assertSee('Log out');
    }
}
