<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenderController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user'])->name('user');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tenders', [TenderController::class, 'store'])->name('tenders.store');
});

Route::get('/tenders/{id}', [TenderController::class, 'show'])->name('tenders.show');
Route::get('/tenders', [TenderController::class, 'index'])->name('tenders.index');
