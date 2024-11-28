<?php

declare(strict_types=1);

namespace Gurulabs\App\Offers\ReadModel;

use DateTimeImmutable;

final readonly class OfferDto
{
    public function __construct(
        private int $auctionId,
        private int $userId,
        private float $bidAmount,
        private DateTimeImmutable $bidTime,
    ) {
    }

    public function getAuctionId(): int
    {
        return $this->auctionId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBidAmount(): float
    {
        return $this->bidAmount;
    }

    public function getBidTime(): DateTimeImmutable
    {
        return $this->bidTime;
    }
}
