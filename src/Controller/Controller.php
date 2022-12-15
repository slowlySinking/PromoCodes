<?php

declare(strict_types=1);

namespace App\Controller;

use App\DependencyInjection\ServiceLocator;
use App\View\View;

abstract class Controller
{
    protected ServiceLocator $serviceLocator;
    protected View $view;

    public function __construct()
    {
        $this->serviceLocator = ServiceLocator::getInstance();
        $this->view = $this->serviceLocator->get(View::class);
    }
}
