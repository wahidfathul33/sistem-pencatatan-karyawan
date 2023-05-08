<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function (){
    Route::get('/email/verify', 'notice')->name('verification.notice');

    Route::get('/email/verification-notification', 'sendEmail')
        ->middleware('throttle:6,1')->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->middleware('signed')->name('verification.verify');
});
