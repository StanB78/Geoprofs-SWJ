<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
//test voor stan
it('user with right role can see the Log Out button', function () {
    $user = User::factory()->create([
        'rol' => 1,
    ]);

    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertDontSeeText('Melding');
    $response->assertSeeText('Log Out');
});


