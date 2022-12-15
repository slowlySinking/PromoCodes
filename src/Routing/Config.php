<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\AuthorizationController;
use App\Controller\ErrorController;
use App\Controller\PromoCodeController;
use App\Controller\RegistrationController;
use App\Controller\UserController;

class Config
{
    public const ROUTE_LOGIN = 'auth/login';
    public const ROUTE_LOGOUT = 'auth/logout';
    public const ROUTE_AUTHORIZE = 'authorize';
    public const ROUTE_REGISTRATION = 'registration';
    public const ROUTE_PROMO_CODE = 'promocode';
    public const ROUTE_USER = 'user';

    public const DEFAULT_ROUTE = self::ROUTE_LOGIN;

    private const ROUTING_SCHEMA = [
        self::ROUTE_LOGIN => [
            'GET' => [
                'controller' => AuthorizationController::class,
                'action' => 'login'
            ]
        ],
        self::ROUTE_LOGOUT => [
            'GET' => [
                'controller' => AuthorizationController::class,
                'action' => 'logout'
            ]
        ],
        self::ROUTE_AUTHORIZE => [
            'POST' => [
                'controller' => AuthorizationController::class,
                'action' => 'authorize'
            ]
        ],
        self::ROUTE_REGISTRATION => [
            'GET' => [
                'controller' => RegistrationController::class,
                'action' => 'get'
            ]
        ],
        self::ROUTE_PROMO_CODE => [
            'GET' => [
                'controller' => PromoCodeController::class,
                'action' => 'get'
            ]
        ],
        self::ROUTE_USER => [
            'GET' => [
                'controller' => UserController::class,
                'action' => 'get'
            ],
            'POST' => [
                'controller' => UserController::class,
                'action' => 'create'
            ]
        ],
    ];

    public static function getRoutingSchema(): array
    {
        return self::ROUTING_SCHEMA;
    }
}
