<?php

declare(strict_types=1);

namespace App\Controller;

use App\Routing\Config;
use App\Services\AuthorizationService;

class AuthorizationController extends Controller
{
    private AuthorizationService $authorizationService;

    public function __construct()
    {
        parent::__construct();

        $this->authorizationService = $this->serviceLocator->get(AuthorizationService::class);
    }

    public function login(): void
    {
        $this->view->render('authorization.php');
    }

    public function logout(): void
    {
        $this->authorizationService->stopSession();

        $this->view->render('authorization.php');
    }

    public function authorize(): void
    {
        $response = $this->authorizationService->authorize($_POST);

        if (isset($response['error'])) {
            $this->view->renderError(401, $response['error']);
            return;
        }

        header('Location: ' . Config::ROUTE_USER);
    }
}
