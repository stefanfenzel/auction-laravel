<?php

namespace Gurulabs\App\Providers;

use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Domain\Offers\OfferRepositoryInterface;
use Gurulabs\Infrastructure\Auctions\EloquentAuctionRepository;
use Gurulabs\Infrastructure\Offers\EloquentOfferRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuctionRepositoryInterface::class, EloquentAuctionRepository::class);
        $this->app->bind(OfferRepositoryInterface::class, EloquentOfferRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
