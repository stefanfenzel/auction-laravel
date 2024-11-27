<?php

use Gurulabs\Http\Auctions\Controllers\AuctionsController;
use Gurulabs\Http\Users\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AuctionsController::class, 'list'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Auction
    Route::post('/auctions', [AuctionsController::class, 'create'])->name('auctions.create');
    Route::get('/auctions/{id}', [AuctionsController::class, 'show'])->name('auctions.show');
    Route::get('/auctions', [AuctionsController::class, 'listByUser'])->name('auctions.list');
});

require __DIR__.'/auth.php';
