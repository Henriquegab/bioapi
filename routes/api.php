<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth.jwt')->group(
    function(){

        Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store');

        Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');

        Route::get('/animal/publicados', [AnimalController::class, 'publicados'])->name('animal.publicados');




    });
