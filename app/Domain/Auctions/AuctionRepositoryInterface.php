<?php

declare(strict_types=1);

namespace Gurulabs\Domain\Auctions;

use Gurulabs\App\Auctions\ReadModel\AuctionDto;

interface AuctionRepositoryInterface
{
    public function findById(int $id): Auction;

    public function findByUserId(int $userId): ?Auction;

    public function findRunningAuctions(): ?Auction;

    public function save(AuctionDto $auction): Auction;
}
