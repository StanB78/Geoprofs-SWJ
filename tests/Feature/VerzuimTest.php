<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

class VerzuimTest extends TestCase
{
    use RefreshDatabase;

    public function test_verlof_aanvragen()
    {

        $user = User::factory()->create(['leaveToken' => 5]);

        try {

            $response = $this->withoutMiddleware()->actingAs($user)->post(route('verzuim'), [
                'melding' => 'Japan',
                'redenverzuim' => 2,
                'startdatum' => now()->toDateString(),
                'einddatum' => now()->addDays(3)->toDateString(),
            ]);


            $response->assertRedirect();


            $this->assertDatabaseHas('meldingen', [
                'userID' => $user->id,
                'soort' => 2,
                'melding' => 'Japan',
            ]);


            $user->refresh();
            $this->assertEquals(4, $user->leaveToken, 'Leave token moet met 1 verminderen bij verlof');

        } catch (QueryException $e) {
            $this->fail("Database query failed: " . $e->getMessage());
        }
    }
}
