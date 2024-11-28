<?php

declare(strict_types=1);

namespace Gurulabs\Domain\Users;

use Gurulabs\App\Users\ReadModel\UserDto;

interface UserRepositoryInterface
{
    public function save(UserDto $user): User;

    public function findById(int $id): ?User;
}
