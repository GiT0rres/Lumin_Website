<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;

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

Route::post('/recomendacoes', [RecommendationController::class, 'store'])
    ->middleware('throttle:5,1')->name('recommendations.store');

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/recomendacoes', [RecommendationController::class, 'index'])->name('recommendations.index');
    Route::patch('/recomendacoes/{recommendation}', [RecommendationController::class, 'update'])->name('recommendations.update');
    Route::delete('/recomendacoes/{recommendation}', [RecommendationController::class, 'destroy'])->name('recommendations.destroy');
});

require __DIR__.'/auth.php';
