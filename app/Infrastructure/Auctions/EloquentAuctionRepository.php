<?php

declare(strict_types=1);

namespace Gurulabs\Infrastructure\Auctions;

use Gurulabs\App\Auctions\ReadModel\AuctionDto;
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

    public function save(AuctionDto $auction): void
    {
        Auction::updateOrCreate(
            ['id' => $auction->getId()],
            [
                'user_id' => $auction->getUserId(),
                'title' => $auction->title,
                'description' => $auction->getDescription(),
                'start_price' => $auction->getStartPrice(),
                'end_date' => $auction->getEndDate()->format('Y-m-d H:i:s'),
            ]
        );
    }

    public function delete(Uuid $id): void
    {
        Auction::destroy($id->toString());
    }
}
