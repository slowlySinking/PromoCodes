<?php

declare(strict_types=1);

namespace App\DB;

class Config
{
    private const DATABASE_SCHEMA = [
        'promo_code',
        'user',
    ];

    public static function getDatabaseSchema(): array
    {
        return self::DATABASE_SCHEMA;
    }
}
