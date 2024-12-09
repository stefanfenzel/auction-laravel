<?php

declare(strict_types=1);

namespace Gurulabs\Domain\Auctions;

use Gurulabs\Domain\Uuid;
use Illuminate\Database\Eloquent\Collection;

interface AuctionRepositoryInterface
{
    public function findById(Uuid $id): Auction;

    public function findByUserId(int $userId): Collection;

    public function findRunningAuctions(): Collection;

    public function save(Auction $auction): void;

    public function delete(Uuid $id): void;
}
