<?php

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

Route::get('/login', [MainController::class, 'login'])->name('guests.login');


