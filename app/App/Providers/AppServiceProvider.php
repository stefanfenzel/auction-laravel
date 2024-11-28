<?php

namespace Gurulabs\App\Providers;

use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Infrastructure\Auctions\EloquentAuctionRepository;
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
