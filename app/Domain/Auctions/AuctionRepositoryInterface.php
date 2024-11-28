<?php

declare(strict_types=1);

namespace Gurulabs\Domain\Auctions;

use Gurulabs\App\Auctions\ReadModel\AuctionDto;
use Illuminate\Database\Eloquent\Collection;

interface AuctionRepositoryInterface
{
    public function findById(int $id): Auction;

    public function findByUserId(int $userId): Collection;

    public function findRunningAuctions(): Collection;

    public function save(AuctionDto $auction): Auction;
}
