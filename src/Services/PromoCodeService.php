<?php

declare(strict_types=1);

namespace App\Services;

use App\DependencyInjection\ServiceLocator;
use App\Entity\PromoCode;
use DateTime;

class PromoCodeService
{
    private PartnerService $partnerService;
    private UserService $userService;

    public function __construct()
    {
        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = ServiceLocator::getInstance();

        $this->partnerService = $serviceLocator->get(PartnerService::class);
        $this->userService = $serviceLocator->get(UserService::class);
    }

    public function issuePromoCode(string $userLogin): array
    {
        $user = $this->userService->getCustomerBy('login', $userLogin);

        $existentPromoCodeId = $user->getPromoCodeId();
        if (null !== $existentPromoCodeId) {
            /** @var PromoCode $promoCode */
            $promoCode = PromoCode::findByWithConversion('id', $existentPromoCodeId);

            return ['redirectUrl' => $this->generateRedirectLink($promoCode->getCode())];
        }

        $promoCode = PromoCode::getFreePromoCode();
        if (null === $promoCode) {
            return ['error' => 'There are no available promo codes'];
        }

        $user->setPromoCodeId($promoCode->getId());
        $user->update();

        $promoCode->setIssueDate(new DateTime());
        $promoCode->update();

        return ['redirectUrl' => $this->generateRedirectLink($promoCode->getCode())];
    }

    private function generateRedirectLink(string $promoCode): string
    {
        return $this->partnerService->getDefaultPartnerRoute() . '?' . $promoCode;
    }
}
