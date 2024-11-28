<?php

declare(strict_types=1);

namespace Gurulabs\Infrastructure\Auctions;

use Gurulabs\App\Auctions\ReadModel\AuctionDto;
use Gurulabs\Domain\Auctions\Auction;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;

final class EloquentAuctionRepository implements AuctionRepositoryInterface
{
    public function findById(int $id): Auction
    {
        return Auction::findOrFail($id);
    }

    public function findByUserId(int $userId): ?Auction
    {
        return Auction::where('user_id', $userId)->get();
    }

    public function findRunningAuctions(): ?Auction
    {
        return Auction::where('end_date', '>', now())->get();
    }

    public function save(AuctionDto $auction): Auction
    {
        // todo implement uuid and set return type to void
        return Auction::create([
            'user_id' => $auction->getUserId(),
            'title' => $auction->getTitle(),
            'description' => $auction->getDescription(),
            'start_price' => $auction->getStartPrice(),
            'end_date' => $auction->getEndDate()->format('Y-m-d H:i:s'),
        ]);
    }
}
