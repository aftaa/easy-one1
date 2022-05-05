<?php

namespace app\controllers\auth;

use app\entities\User;
use app\storages\UserStorage;
use easy\auth\PasswordHash;
use easy\basic\router\Route;
use easy\http\Request;
use easy\mail\Email;
use easy\mail\EmailBody;
use easy\MVC\Controller;

class RegisterController extends Controller
{
    #[Route('/register', name: 'register')]
    public function register(UserStorage $storage, Request $request, PasswordHash $passwordHash)
    {
        $errorMessage = '';
        $done = false;
        $email = $request->query('email');
        $username = $request->query('username');
        if ($request->isPost()) {
            try {
                $password1 = $request->query('password1');
                $password2 = $request->query('password2');

                if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Email is not valid');
                }

                if (!strlen($username) || !strlen($password1) || !strlen($password2)) {
                    throw new \Exception('All fields are required');
                }

                if ($storage->emailExists($email)) {
                    throw new \Exception('E-mail already in use');
                }

                if ($storage->usernameExists($username)) {
                    throw new \Exception('Username already in use');
                }

                if ($password1 != $password2) {
                    throw new \Exception('Passwords don\'t matches');
                }

                $user = new User;
                $user->email = $email;
                $user->username = $username;
                $user->password = $passwordHash->makeHash($password1);
                $user->is_verified = 0;
                $user->roles = '[]';
                $user->register = md5($email . $username . time());
                $storage->store($user);

                $done = (new Email())
                    ->addTo($email, $username)
                    ->setSubject('activate user')
                    ->setFrom('max@kuba.msk.ru')
                    ->setBody(new EmailBody('
                        To activate user please follow link: 
                        http://easy-one/activate?code=' . $user->register . '
                    ', ''))
                    ->send();

            } catch (\Exception $exception) {
                $errorMessage = $exception->getMessage();
            }
        }

        $this->render('auth/register', [
            'errorMessage' => $errorMessage,
            'email' => $email,
            'username' => $username,
            'done' => $done,
        ]);
    }

    #[Route('/activate', name: 'activate')]
    public function activate(UserStorage $storage, Request $request)
    {
        $registerCode = $request->query('code');
        $storage->activateUser($registerCode);
        $this->redirectToRoute('login');
    }
}