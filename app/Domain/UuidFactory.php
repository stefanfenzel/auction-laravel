<?php

declare(strict_types=1);

namespace Gurulabs\Domain;

interface UuidFactory
{
    public function create(): Uuid;
}
