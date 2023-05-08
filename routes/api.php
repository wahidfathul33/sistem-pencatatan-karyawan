<?php

use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\SiakadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('pegawai/dropdown-list', [PegawaiController::class, 'dropdownList'])->name('pegawai.dropdown-list');
Route::get('pegawai/{id}', [PegawaiController::class, 'detail'])->name('pegawai.detail');

Route::get('mhs', [SiakadController::class, 'index'])->name('mhs.index');
Route::get('mhs/dropdown-list', [SiakadController::class, 'dropdownList'])->name('mhs.dropdown-list');
Route::get('mhs/{id}', [SiakadController::class, 'detail'])->name('mhs.detail');
