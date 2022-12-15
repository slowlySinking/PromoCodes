<?php

declare(strict_types=1);

namespace App\Services\Validator;

class PasswordValidator extends Validator
{
    public function validate(array $data): ?string
    {
        $password = $data['password'];
        $passwordConfirm = $data['password_confirm'];

        if ($password !== $passwordConfirm) {
            return 'passwords are different';
        }

        return null;
    }
}
