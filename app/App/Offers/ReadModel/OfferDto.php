<?php

declare(strict_types=1);

namespace Gurulabs\App\Offers\ReadModel;

use DateTimeImmutable;

final readonly class OfferDto
{
    public function __construct(
        private string $id,
        private string $auctionId,
        private int $userId,
        private float $bidAmount,
        private DateTimeImmutable $bidTime,
    ) {
    }

    public function getAuctionId(): string
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

    public function getId(): string
    {
        return $this->id;
    }
}
