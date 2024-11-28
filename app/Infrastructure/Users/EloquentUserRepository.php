<?php

declare(strict_types=1);

namespace Gurulabs\Infrastructure\Users;

use Gurulabs\App\Users\ReadModel\UserDto;
use Gurulabs\Domain\Users\User;
use Gurulabs\Domain\Users\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(UserDto $user): User
    {
        $user = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);

        event(new Registered($user));

        return $user;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}
