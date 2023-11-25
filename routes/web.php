<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/detail/{car}', [HomepageController::class, 'show'])->name('detail');
Route::middleware('auth')->group(function () {
    Route::post('/booking/{car}', [HomepageController::class, 'booking'])->name('booking');
    Route::post('/payment/{car}', [HomepageController::class, 'payment'])->name('payment');
});


Route::middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [HomepageController::class, 'index_admin'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('auth', 'admin')->prefix('cars')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('cars');
        Route::get('/create', [CarController::class, 'create'])->name('cars.create');
        Route::post('/store', [CarController::class, 'store'])->name('cars.store');
        Route::delete('/destroy/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    });
});

require __DIR__.'/auth.php';
