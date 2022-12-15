<?php

declare(strict_types=1);

namespace App\Library;

use Dotenv\Dotenv;

class DotenvHelper
{
    public static function loadEnvFiles(): void
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }
}
