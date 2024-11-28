<?php

declare(strict_types=1);

namespace Gurulabs\App\Auctions\ReadModel;

use DateTimeImmutable;

final readonly class AuctionDto
{
    public function __construct(
        private int $userId,
        private string $title,
        private string $description,
        private float $startPrice,
        private DateTimeImmutable $endDate,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStartPrice(): float
    {
        return $this->startPrice;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}
