<?php

use Gurulabs\App\Auctions\Controllers\AuctionsController;
use Gurulabs\App\Offers\Controllers\OffersController;
use Gurulabs\App\Users\Controllers\ProfileController;
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
        Route::get('/auctions/{id}', 'show')
            ->whereUuid('id')
            ->name('auctions.show');

        Route::get('/auctions', 'listByUser')->name('auctions.list');
        Route::get('/auctions/create', 'create')->name('auctions.create');
        Route::post('/auctions', 'store')->name('auctions.store');

        Route::post('/auctions/{id}/delete', 'delete')
            ->whereUuid('id')
            ->name('auctions.delete');

        Route::get('/auctions/{id}/edit', 'edit')
            ->whereUuid('id')
            ->name('auctions.edit');

        Route::post('/auctions/{id}/update', 'update')
            ->whereUuid('id')
            ->name('auctions.update');
    });

    // Offer
    Route::post('/auctions/{id}/offer', [OffersController::class, 'placeBid'])
        ->whereUuid('id')
        ->name('offers.place-bid');
});

require __DIR__.'/auth.php';
