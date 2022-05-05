<?php

namespace app\controllers\auth;

use app\entities\User;
use app\storages\UserStorage;
use easy\auth\PasswordHash;
use easy\basic\router\Route;
use easy\http\Request;
use easy\MVC\Controller;

class ResetPasswordController extends Controller
{
    #[Route('/reset', name: 'reset')]
    public function resetPassword(Request $request, UserStorage $storage, PasswordHash $passwordHash)
    {
        $error = null;
        $code = $request->query('code');

        if ($request->isPost()) {
            try {
                $password1 = $request->query('password1');
                $password2 = $request->query('password2');
                if (!strlen($password1) || !strlen($password2)) {
                    throw new \Exception('Empty passwords');
                }
                if ($password1 != $password2) {
                    throw new \Exception('Passwords don\'t match');
                }
                $password = $passwordHash->makeHash($password1);
                $storage->updatePassword($code, $password);
                $this->redirectToRoute('login');
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        $this->render('auth/reset', [
            'error' => $error,
            'code' => $code,
        ]);
    }
}