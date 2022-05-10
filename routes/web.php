<?php

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

Route::get('/test', function () {
    $user = new \App\Models\User;
    $user->cedula = '123456';
    $user->name = 'Juanito';
    $user->email = 'juan@gmail.com';
    $user->password =  "123456789";
    $user->save();

    Auth::login($user);
    Route::redirect()->route('home');
    // return $user;
});

Route::middleware('guest')->group(function () {
    Route::view('/login', 'welcome');
    Route::post('/login', [\App\Http\Controllers\adminController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\adminController::class, 'logout'])->name('logout');
    Route::view('/', 'admin')->name('home');
});
