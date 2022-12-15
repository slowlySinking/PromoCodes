<?php

declare(strict_types=1);

namespace App\Services;

class PartnerService
{
    private const DEFAULT_PARTNER_URL = 'https://www.google.com';

    public function getDefaultPartnerRoute(): string
    {
        return self::DEFAULT_PARTNER_URL;
    }
}
