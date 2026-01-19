<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create admin or manager user
    $this->admin = User::factory()->create([
        'email' => 'amira70@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin', // adjust role as needed
    ]);

    // Simulate login
    $this->actingAs($this->admin);
});

it('downloads the Verzuim log PDF', function () {
    // Request the Verzuim log PDF route
    $response = $this->get('/melding/pdf');

    // Assert status 200
    $response->assertStatus(200);

    // Assert response is a PDF
    $response->assertHeader('Content-Type', 'application/pdf');
});

it('downloads the Werknemer lijst PDF', function () {
    // Request the Werknemer lijst PDF route
    $response = $this->get('/werknemers/pdf');

    // Assert status 200
    $response->assertStatus(200);

    // Assert response is a PDF
    $response->assertHeader('Content-Type', 'application/pdf');
});
