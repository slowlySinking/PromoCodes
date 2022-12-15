<?php

declare(strict_types=1);

namespace App\Controller;

use App\Routing\Config;
use App\Services\AuthorizationService;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    private AuthorizationService $authorizationService;

    public function __construct()
    {
        parent::__construct();

        $this->userService = $this->serviceLocator->get(UserService::class);
        $this->authorizationService = $this->serviceLocator->get(AuthorizationService::class);
    }

    public function get(): void
    {
        $login = $this->authorizationService->getAuthCustomerLogin();
        if (!$login) {
            header('Location: ' . Config::ROUTE_LOGIN);
        }

        $user = $this->userService->getCustomerBy('login', $login);

        $this->view->render('profile.php', ['user' => $user]);
    }

    public function create(): void
    {
        $response = $this->userService->createCustomer($_POST);

        if (isset($response['error'])) {
            $this->view->renderError(400, $response['error']);
            return;
        }

        header('Location: ' . Config::ROUTE_LOGIN);
    }
}
