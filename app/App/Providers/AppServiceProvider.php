<?php

namespace Gurulabs\App\Providers;

use Gurulabs\App\UuidFromRamseyFactory;
use Gurulabs\App\View\Components\AppLayout;
use Gurulabs\App\View\Components\GuestLayout;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Domain\Offers\OfferRepositoryInterface;
use Gurulabs\Domain\Users\UserRepositoryInterface;
use Gurulabs\Domain\UuidFactory;
use Gurulabs\Infrastructure\Auctions\EloquentAuctionRepository;
use Gurulabs\Infrastructure\Offers\EloquentOfferRepository;
use Gurulabs\Infrastructure\Users\EloquentUserRepository;
use Illuminate\Support\Facades\Blade;
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
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(UuidFactory::class, UuidFromRamseyFactory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);
    }
}
