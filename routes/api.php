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

Route::post('/user/forgot_password', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');


Route::middleware(['auth.jwt','verifica.email'])->group(
    function(){



        Route::patch('/user/update_password', [AuthController::class, 'update'])->name('auth.update');

        Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store');

        Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');

        Route::get('/animal/publicados', [AnimalController::class, 'publicados'])->name('animal.publicados');

        Route::get('/animal/todos', [AnimalController::class, 'todos'])->name('animal.todos');




    });
