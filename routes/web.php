<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//get = specific function in controller
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//resource = used all function
Route::middleware(['auth'])->group(function () {
    Route::resource('room', App\Http\Controllers\RoomController::class);
    Route::resource('booking', App\Http\Controllers\BookingController::class);
});
