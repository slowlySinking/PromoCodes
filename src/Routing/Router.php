<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\ErrorController;
use App\DependencyInjection\ServiceLocator;
use App\View\View;

class Router
{
    private ServiceLocator $serviceLocator;

    public function __construct()
    {
        $this->serviceLocator = ServiceLocator::getInstance();
    }

    public function run(): void
    {
        $routeInfo = $this->getRouteInfo();
        if (!$routeInfo) {
            $this->processError();
            return;
        }

        $controller = $this->serviceLocator->get($routeInfo['controller']);
        $action = $routeInfo['action'];

        call_user_func([$controller, $action]);
    }

    private function getRouteInfo(): array
    {
        $routing = $this->getRouting();

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        if (!$requestUri) {
            $this->redirectToDefaultRoute();
        }

        return $routing[$requestUri][$requestMethod] ?? [];
    }

    private function getRouting(): array
    {
        return Config::getRoutingSchema();
    }

    private function processError(): void
    {
        /** @var View $view */
        $view = $this->serviceLocator->get(View::class);

        $view->renderError(404);
    }

    private function redirectToDefaultRoute(): void
    {
        header('Location: ' . Config::DEFAULT_ROUTE);
    }
}
