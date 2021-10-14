<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

//to verify email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//resource = used all function
Route::middleware(['auth', 'verified'])->group(function () { //untuk masuk kena log in dulu
    //get = specific function in controller
    Route::resource('room', App\Http\Controllers\RoomController::class);
    Route::resource('booking', App\Http\Controllers\BookingController::class);
    Route::resource('notification', App\Http\Controllers\NotificationController::class); //get notification and email
});

Route::get('/login-as/{username}', function ($username) {
    $user = \App\Models\User::where('email', $username . '@domain.com')->first();
    if ($user) {
        Auth::loginUsingId($user->id, true);
    } else {
        dd('Username not found!');
    }
    return redirect()->route('home');
});

