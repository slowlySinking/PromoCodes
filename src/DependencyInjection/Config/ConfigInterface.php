<?php

namespace App\DependencyInjection\Config;

interface ConfigInterface
{
    public static function getDependenciesSchema(): array;
}
