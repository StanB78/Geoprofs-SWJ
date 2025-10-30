<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('returns 403 when a guest tries to access the register page', function () {
    $response = $this->get('/register');

    $response->assertStatus(403);
});

it('sum of 2 numbers works', function () {
    expect(3+2)->toBe(5);
});



it('allows a logged-in user to access the register page', function () {
    $user = User::create([
        'name' => 'test',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'rol' => 3,
        'leaveToken' => 2,
    ]);

    $this->actingAs($user);

    $response = $this->get('/register');

    $response->assertStatus(200);
});
