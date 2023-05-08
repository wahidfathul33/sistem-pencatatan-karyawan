<?php

use Illuminate\Support\Facades\Route;

Route::get('/forgot-password', 'passwordRequest')->name('password.request');
Route::post('/forgot-password', 'passwordEmail')->name('password.email');
Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');
Route::post('/reset-password', 'passwordUpdate')->name('password.update');
