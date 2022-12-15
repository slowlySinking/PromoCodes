<?php

declare(strict_types=1);

namespace App\DependencyInjection\Config;

use App\Routing\Router;
use App\Services\AuthorizationService;
use App\Services\PartnerService;
use App\Services\PromoCodeService;
use App\Services\UserService;
use App\View\View;

class ServiceConfig implements ConfigInterface
{
    private const DEPENDENCY_INJECTIONS_SCHEMA = [
        Router::class,
        View::class,
        AuthorizationService::class,
        UserService::class,
        PartnerService::class,
        PromoCodeService::class,
    ];

    public static function getDependenciesSchema(): array
    {
        return self::DEPENDENCY_INJECTIONS_SCHEMA;
    }
}
