<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/verlof', function () {
    return view('verlof');
});

Route::get('/ziekmelden', function () {
    return view('ziekmelden');
});

