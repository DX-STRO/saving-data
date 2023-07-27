<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [ProfileController::class, 'index'])->middleware('auth');
Route::post('/add-profile', [ProfileController::class, 'store'])->middleware('auth');
Route::put('/edit-profile/{id}', [ProfileController::class, 'edit'])->middleware('auth');
Route::delete('/delete-profile/{id}', [ProfileController::class, 'destroy'])->middleware('auth');
Route::get('/search-profile', [ProfileController::class, 'search'])->middleware('auth');
Route::get('/export-excel', [ProfileController::class, 'exportExcel'])->middleware('auth');
