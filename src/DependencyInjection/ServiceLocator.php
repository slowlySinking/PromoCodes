<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\Library\Singleton\SingletonInterface;
use App\Library\Singleton\SingletonTrait;

class ServiceLocator implements SingletonInterface
{
    use SingletonTrait;

    private DependenciesFactory $factory;

    private function __construct()
    {
        $this->factory = new DependenciesFactory();
    }

    public function get(string $serviceName): ?object
    {
        return $this->factory->getDependencies()[$serviceName] ?? null;
    }
}
