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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth.web')->group(function () {
    Route::get('/change-email/{user}', [App\Http\Controllers\UserController::class, 'changeEmailForm'])->name('change.email');
    Route::get('/change-email-form', [App\Http\Controllers\UserController::class, 'showChangeEmailForm'])->name('change.email.form');
    Route::post('/change-email', [App\Http\Controllers\UserController::class, 'changeEmail'])->name('change.email.post');

    Route::get('/profile/{userId}', [App\Http\Controllers\UserController::class, 'showProfile'])->name('profile');

    Route::get('/add-images-form', [App\Http\Controllers\UserController::class, 'showAddImagesForm'])->name('add.images.form');
    Route::post('/add-images', [App\Http\Controllers\UserController::class, 'addImages'])->name('add.images.post');
});


