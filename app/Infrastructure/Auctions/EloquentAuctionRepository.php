<?php

declare(strict_types=1);

namespace Gurulabs\Infrastructure\Auctions;

use Gurulabs\Domain\Auctions\Auction;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Domain\Uuid;
use Illuminate\Database\Eloquent\Collection;

final class EloquentAuctionRepository implements AuctionRepositoryInterface
{
    public function findById(Uuid $id): Auction
    {
        return Auction::findOrFail($id->toString());
    }

    public function findByUserId(int $userId): Collection
    {
        return Auction::where('user_id', $userId)->get();
    }

    public function findRunningAuctions(): Collection
    {
        return Auction::where('end_date', '>', now())->get();
    }

    public function save(Auction $auction): void
    {
        $auction->save();
    }

    public function delete(Uuid $id): void
    {
        Auction::destroy($id->toString());
    }
}
