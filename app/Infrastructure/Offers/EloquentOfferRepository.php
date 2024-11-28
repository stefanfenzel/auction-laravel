<?php

declare(strict_types=1);

namespace Gurulabs\Infrastructure\Offers;

use Gurulabs\App\Offers\ReadModel\OfferDto;
use Gurulabs\Domain\Offers\Offer;
use Gurulabs\Domain\Offers\OfferRepositoryInterface;

final class EloquentOfferRepository implements OfferRepositoryInterface
{
    public function save(OfferDto $offer): Offer
    {
        // todo implement uuid and set return type to void
        return Offer::create([
            'auction_id' => $offer->getAuctionId(),
            'user_id' => $offer->getUserId(),
            'bid_amount' => $offer->getBidAmount(),
            'bid_time' => $offer->getBidTime()->format('Y-m-d H:i:s'),
        ]);
    }
}
