<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\DependencyInjection\ServiceLocator;
use App\Routing\Router;

/** @var ServiceLocator $serviceLocator */
$serviceLocator = ServiceLocator::getInstance();

/** @var Router $router */
$routerService = $serviceLocator->get(Router::class);

$routerService->run();
