<?php

use Gurulabs\Http\Auctions\Controllers\AuctionsController;
use Gurulabs\Http\Offers\Controllers\OffersController;
use Gurulabs\Http\Users\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('auctions.app');
});

Route::get('/dashboard', [AuctionsController::class, 'list'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Auction
    Route::controller(AuctionsController::class)->group(function () {
        Route::get('/orders/{id}', 'show');
        Route::post('/orders', 'store');

        Route::get('/auctions/{id}', 'show')
            ->where('id', '[0-9]+')
            ->name('auctions.show');

        Route::get('/auctions', 'listByUser')->name('auctions.list');
        Route::get('/auctions/create', 'create')->name('auctions.create');
        Route::post('/auctions', 'store')->name('auctions.store');
    });

    // Offer
    Route::post('/auctions/{id}', [OffersController::class, 'placeBid'])
        ->where('id', '[0-9]+')
        ->name('offers.place-bid');
});

require __DIR__.'/auth.php';
