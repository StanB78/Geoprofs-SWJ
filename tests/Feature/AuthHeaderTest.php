<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('guest sees login and not logout', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Log in')
        ->assertDontSee('Log out')
        ->assertDontSee('Create new User');
});

it('user with role 1 sees verzuim and logout', function () {
    $user = User::factory()->create(['rol' => 1]);

    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Logged in as:')
        ->assertSee('Niet')
        ->assertSee('Log out')
        ->assertDontSee('Create new User');
});

it('user with role 2 sees melding button', function () {
    $user = User::factory()->create(['rol' => 2]);

    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Logged in as:')
        ->assertSee('Melding') // assuming this is the button text
        ->assertSee('Log out')
        ->assertDontSee('Create new User');
});

it('user with role 3 sees create user button', function () {
    $user = User::factory()->create(['rol' => 3]);

    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Logged in as:')
        ->assertSee('Create new User')
        ->assertSee('Log out');
});
