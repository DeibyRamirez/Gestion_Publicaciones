<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrincipalController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/publicaciones', action: [PrincipalController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/create', [PrincipalController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', action: [PrincipalController::class, 'store'])->name('publicaciones.store');
    Route::get('/publicaciones/{id}', action: [PrincipalController::class, 'show'])->name('publicaciones.show');
    Route::get('/publicaciones/{id}/edit', action: [PrincipalController::class, 'edit'])->name('publicaciones.edit');
    Route::put('/publicaciones/{id}', action: [PrincipalController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{id}', [PrincipalController::class, 'destroy'])->name('publicaciones.destroy');
});
