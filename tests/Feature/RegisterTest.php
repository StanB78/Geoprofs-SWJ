<?php

it('shows the register page', function () {
    $response = $this->get('/register');

    $response->assertStatus(403);
});

it('sum of 2 numbers works', function () {
    expect(3+2)->toBe(5);
});


