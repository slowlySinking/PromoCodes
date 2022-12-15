<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\DependencyInjection\Config\ControllerConfig;
use App\DependencyInjection\Config\ServiceConfig;
use App\DependencyInjection\Config\ValidatorConfig;

class DependenciesFactory
{
    /** @var object[]  */
    private array $dependencies = [];

    public function getDependencies(): array
    {
        if (!$this->dependencies) {
            $this->create();
        }

        return $this->dependencies;
    }

    private function create(): void
    {
        $dependencies = array_merge(
            ValidatorConfig::getDependenciesSchema(),
            ServiceConfig::getDependenciesSchema(),
            ControllerConfig::getDependenciesSchema(),
        );

        foreach ($dependencies as $className) {
            if (class_exists($className)) {
                $this->dependencies[$className] = new $className();
            }
        }
    }
}
