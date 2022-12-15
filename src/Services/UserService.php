<?php

declare(strict_types=1);

namespace App\Services;

use App\DependencyInjection\ServiceLocator;
use App\Entity\User;
use App\Services\Validator\PasswordValidator;
use App\Services\Validator\UserValidator;

class UserService
{
    private UserValidator $userValidator;
    private PasswordValidator $passwordValidator;
    private AuthorizationService $authorizationService;

    public function __construct()
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = ServiceLocator::getInstance();

        $this->userValidator = $serviceLocator->get(UserValidator::class);
        $this->passwordValidator = $serviceLocator->get(PasswordValidator::class);
        $this->authorizationService = $serviceLocator->get(AuthorizationService::class);
    }

    public function createCustomer(array $data): ?array
    {
        $error = $this->userValidator->validate($data) ??
            $this->passwordValidator->validate($data);

        if ($error) {
            return ['error' => $error];
        }

        if (User::existsBy('login', $data['login'])) {
            return ['error' => 'login is already in use'];
        }

        if (User::existsBy('email', $data['email'])) {
            return ['error' => 'email is already in use'];
        }

        $hashedPassword = $this->authorizationService->hashPassword($data['password']);

        $user = (new User())
            ->setLogin($_POST['login'])
            ->setEmail($_POST['email'])
            ->setPassword($hashedPassword);

        $user->insert();

        return null;
    }

    public function getCustomerBy(string $key, mixed $value): ?User
    {
        return User::findByWithConversion($key, $value);
    }
}
