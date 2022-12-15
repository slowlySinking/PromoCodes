<?php

declare(strict_types=1);

namespace App\Controller;

class RegistrationController extends Controller
{
    public function get(): void
    {
        $this->view->render('registration.php');
    }
}
