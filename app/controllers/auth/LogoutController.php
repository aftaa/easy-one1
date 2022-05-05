<?php

namespace app\controllers\auth;

use easy\auth\Authenticate;
use easy\auth\RememberMe;
use easy\basic\router\Route;
use easy\MVC\Controller;

class LogoutController extends Controller
{
    #[Route('/logout', name: 'logout')]
    public function logout(Authenticate $authenticate, RememberMe $rememberMe)
    {
        $authenticate->logout();
        $rememberMe->forget();
        $this->back();
    }
}
