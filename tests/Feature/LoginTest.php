<?php

it('has login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('user login', function () {

});
