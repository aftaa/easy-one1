<?php

namespace app\controllers\auth;

use app\storages\UserStorage;
use easy\auth\RecoveryPassword;
use easy\basic\router\Route;
use easy\http\Request;
use easy\MVC\Controller;

class RecoveryPasswordController extends Controller
{
    /**
     * @throws \Throwable
     */
    #[Route('/recovery', name: 'recovery')]
    public function recovery(UserStorage $storage, Request $request, RecoveryPassword $recoveryPassword)
    {
        $error = null;
        $done = null;
        $email = $request->query('email');

        if ($request->isPost()) {
            try {
                if (!$storage->emailExists($email)) {
                    throw new \Exception("E-mail $email not found in database");
                }

                $recoveryPassword->email = $email;
                $recoveryPassword->makeRecoveryCode();
                $done = $recoveryPassword->sendRecoveryMail();
                $storage->insertRecovery($email, $recoveryPassword->recoveryCode);
                $done = true;
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }


        $this->render('auth/recovery', [
            'error' => $error,
            'email' => $email,
            'done' => $done,
        ]);
    }
}