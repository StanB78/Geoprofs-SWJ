<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('guest user (not logged in) try to go to /register', function () {
    //go to /register page
    $response = $this->get('/register');
    //should get 403 melding (no right to see this page)
    $response->assertStatus(403);
});


//real test
it('sum of 2 numbers works', function () {

    //3+2 should be 5
    expect(3+2)->toBe(5);
});




it('user whit right role can see register test role 1,2 and 3', function ($role, $expectedStatus) {

//we fake the login and give then diff role
    $user = User::factory()->create([
        'rol' => $role,
    ]);
    $this->actingAs($user);
//go to /register
    $response = $this->get('/register');

//only user whit role 3 can go the /register
    $response->assertStatus($expectedStatus);
})->with([
    [1, 403],
    [2, 403],
    [3, 200],
]);

