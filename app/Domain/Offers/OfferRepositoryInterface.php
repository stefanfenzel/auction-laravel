<?php

declare(strict_types=1);

namespace Gurulabs\Domain\Offers;

use Gurulabs\App\Offers\ReadModel\OfferDto;

interface OfferRepositoryInterface
{
    public function save(OfferDto $offer): Offer;
}
