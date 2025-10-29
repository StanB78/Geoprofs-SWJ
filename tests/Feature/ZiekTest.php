<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

class ZiekTest extends TestCase
{
    use RefreshDatabase;

    public function test_ziek_melding()
    {

        $user = User::factory()->create(['leaveToken' => 5]);

        try {

            $response = $this->withoutMiddleware()->actingAs($user)->post(route('verzuim'), [
                'melding' => 'Ik ben ziek ben dood',
                'redenverzuim' => 1,
                'startdatum' => now()->toDateString(),
                'einddatum' => now()->addDays(2)->toDateString(),
            ]);


            $response->assertRedirect();


            $this->assertDatabaseHas('meldingen', [
                'userID' => $user->id,
                'soort' => 1,
                'melding' => 'Ik ben ziek ben dood',
            ]);


            $user->refresh();
            $this->assertEquals(5, $user->leaveToken, 'Leave token mag niet veranderen bij ziekmelding');

        } catch (QueryException $e) {
            $this->fail("Database query failed: " . $e->getMessage());
        }
    }
}
