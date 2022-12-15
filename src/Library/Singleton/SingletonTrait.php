<?php

namespace App\Library\Singleton;

trait SingletonTrait
{
    private static ?object $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): object
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
