<?php

declare(strict_types=1);

namespace App\Constants\User;

class SuperUserConstant
{
    private const SUPERUSER = [
        'id' => 1,
        'name' => 'Superuser'
    ];

    public static function isSuperUser(int $userId): bool
    {
        return self::SUPERUSER['id'] === $userId;
    }

    public static function getId(): int
    {
        return self::SUPERUSER['id'];
    }

    public static function getName(): string
    {
        return self::SUPERUSER['name'];
    }
}
