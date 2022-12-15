<?php

declare(strict_types=1);

namespace App\DependencyInjection\Config;

use App\Controller\AuthorizationController;
use App\Controller\PromoCodeController;
use App\Controller\RegistrationController;
use App\Controller\UserController;

class ControllerConfig implements ConfigInterface
{
    private const DEPENDENCY_INJECTIONS_SCHEMA = [
        AuthorizationController::class,
        PromoCodeController::class,
        RegistrationController::class,
        UserController::class,
    ];

    public static function getDependenciesSchema(): array
    {
        return self::DEPENDENCY_INJECTIONS_SCHEMA;
    }
}
