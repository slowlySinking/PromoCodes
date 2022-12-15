<?php

declare(strict_types=1);

namespace App\Services\Validator;

class UserValidator extends Validator
{
    protected static array $rules = [
        'login' => ['string', ['max' => 10]],
        'email' => ['string', 'email', ['max' => 20]],
    ];
}
