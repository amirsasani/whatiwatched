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

require __DIR__.'/auth.php';

Route::get('redirect/{driver}', [\App\Http\Controllers\Auth\SocialLoginController::class, 'redirect'])->name('auth.social.redirect');
Route::get('{driver}/callback', [\App\Http\Controllers\Auth\SocialLoginController::class, 'callback'])->name('auth.social.callback');
Route::any('{driver}/login', [\App\Http\Controllers\Auth\SocialLoginController::class, 'login'])->name('auth.social.login');

Route::get('/', [\App\Http\Controllers\TitleController::class, "index"])->name("index");
Route::get('/home', [\App\Http\Controllers\TitleController::class, "index"])->name("home");
Route::get('/dashboard', [\App\Http\Controllers\TitleController::class, "index"])->middleware(['auth'])->name('dashboard');

Route::get('titles/{title}/poster', [\App\Http\Controllers\TitleController::class, 'poster'])->name('titles.poster');
Route::resource('titles', \App\Http\Controllers\TitleController::class);
