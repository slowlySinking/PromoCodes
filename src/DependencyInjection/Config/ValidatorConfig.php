<?php

declare(strict_types=1);

namespace App\DependencyInjection\Config;

use App\Services\Validator\PasswordValidator;
use App\Services\Validator\UserValidator;

class ValidatorConfig implements ConfigInterface
{
    private const DEPENDENCY_INJECTIONS_SCHEMA = [
        UserValidator::class,
        PasswordValidator::class,
    ];

    public static function getDependenciesSchema(): array
    {
        return self::DEPENDENCY_INJECTIONS_SCHEMA;
    }
}
