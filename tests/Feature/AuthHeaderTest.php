<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('user with right role can see the Log Out button', function () {
    $user = User::factory()->create([
        'rol' => 1,
    ]);

    $this->actingAs($user);

    $response = $this->get('/dashboard');

    $response->assertDontSeeText('Melding');
    $response->assertSeeText('Log Out');
});

it('user with right role can see the Melding button', function () {
    $user = User::factory()->create([
        'rol' => 2,
    ]);

    $this->actingAs($user);

    $response = $this->get('/dashboard');

    $response->assertSeeText('Melding');
    $response->assertSeeText('verzuim');
    $response->assertSeeText('Log Out');
});

it('user with right role can see the Create a User button', function () {
    $user = User::factory()->create([
        'rol' => 3,
    ]);

    $this->actingAs($user);

    $response = $this->get('/dashboard');

    $response->assertSeeText('Melding');
    $response->assertSeeText('verzuim');
    $response->assertSeeText('Create new User');
    $response->assertSeeText('Log Out');
});



