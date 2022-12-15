<?php

declare(strict_types=1);

namespace App\Services;

use App\DependencyInjection\ServiceLocator;

class AuthorizationService
{
    public function authorize(array $data): ?array
    {
        $errorResponse = ['error' => 'Login or password is incorrect'];

        $login = $data['login'] ?? null;
        $password = $data['password'] ?? null;
        if (!$login || !$password) {
            return $errorResponse;
        }

        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = ServiceLocator::getInstance();

        /** @var UserService $userService */
        $userService = $serviceLocator->get(UserService::class);
        $user = $userService->getCustomerBy('login', $login);
        if (!$user) {
            return $errorResponse;
        }

        if (!$this->verifyPassword($password, $user->getPassword())) {
            return $errorResponse;
        }

        session_start();
        $_SESSION['login'] = $user->getLogin();

        return null;
    }

    public function stopSession(): void
    {
        session_start();
        unset($_SESSION['login']);
    }

    public function getAuthCustomerLogin(): ?string
    {
        session_start();

        return $_SESSION['login'] ?? null;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
