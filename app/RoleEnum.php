<?php
declare(strict_types=1);
namespace App;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case GUEST = 'guest';

    public static function values(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::GUEST->value,
        ];
    }
}

