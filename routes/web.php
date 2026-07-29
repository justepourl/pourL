<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello from Laravel';
});

Route::get('/letter', function () {
    return view('welcome');
});
