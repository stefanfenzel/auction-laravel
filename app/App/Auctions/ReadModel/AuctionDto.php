<?php

declare(strict_types=1);

namespace Gurulabs\App\Auctions\ReadModel;

use DateTimeImmutable;

final class AuctionDto
{
    public function __construct(
        private readonly string $id,
        private readonly int $userId,
        public string $title,
        private string $description,
        private readonly float $startPrice,
        private readonly DateTimeImmutable $endDate,
    ) {
        $this->title = htmlentities($title);
        $this->description = htmlentities($description);
    }

    public function getUserId(): int
    {
        return $this->userId;
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

    public function getId(): string
    {
        return $this->id;
    }
}
