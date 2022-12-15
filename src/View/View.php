<?php

declare(strict_types=1);

namespace App\View;

class View
{
    public function render(string $template, array $data = []): void
    {
        include __DIR__ . '/../templates/' . $template;
    }

    public function renderError(int $httpCode, ?string $errorMessage = null): void
    {
        include __DIR__ . '/../templates/errors/' . $httpCode . '.php';
    }
}
