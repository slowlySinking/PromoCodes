<?php

declare(strict_types=1);

namespace App\Controller;

use App\Routing\Config;
use App\Services\AuthorizationService;
use App\Services\PromoCodeService;

class PromoCodeController extends Controller
{
    private AuthorizationService $authorizationService;
    private PromoCodeService $promoCodeService;

    public function __construct()
    {
        parent::__construct();

        $this->authorizationService = $this->serviceLocator->get(AuthorizationService::class);
        $this->promoCodeService = $this->serviceLocator->get(PromoCodeService::class);
    }

    public function get(): void
    {
        $login = $this->authorizationService->getAuthCustomerLogin();
        if (!$login) {
            header('Location: ' . Config::ROUTE_LOGIN);
        }

        $response = $this->promoCodeService->issuePromoCode($login);

        if (isset($response['error'])) {
            $this->view->renderError(406, $response['error']);
            return;
        }

        header('Location: ' . $response['redirectUrl']);
    }
}
