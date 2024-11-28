<?php

declare(strict_types=1);

namespace Gurulabs\App;

use Gurulabs\Domain\Uuid;
use Gurulabs\Domain\UuidFactory;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class UuidFromRamseyFactory implements UuidFactory
{
    public function create(): Uuid
    {
        return Uuid::fromString(RamseyUuid::uuid7()->toString());
    }
}
