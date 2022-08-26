<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guests\MainController;

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

/* Partie utilisateur */

Route::get('/', [MainController::class, 'welcome'])->name('guests.welcome');

Route::get('/acces', [MainController::class, 'login'])->name('guests.login');

Route::post('/inscription', [RegisterController::class, 'registerNewUser'])->name('guests.registration');

Route::post('/connexion', [LoginController::class, 'login'])->name('guests.login.processing');

Route::get('/connexion-via-google', [RegisterController::class, 'redirectToGoogle'])->name('guests.google.redirection');

Route::get('/connexion-via-google/callback', [RegisterController::class, 'handleGoogleCallback'])->name('guests.google.callback');


/* Partie Administrateur */
Route::get('dashboard', [AdminMainController::class, 'dashboard'])->name('admin.dashboard');
