<?php

namespace app\controllers;

use app\storages\GroupStorage;
use app\storages\UserStorage;
use easy\basic\router\Route;
use easy\http\Request;
use easy\MVC\Controller;

#[Route('/users')]
class UserController extends Controller
{
    /**
     * @throws \Exception
     */
    #[Route('/list', name: 'user_list')]
    public function list(UserStorage $userStorage, GroupStorage $groupStorage)
    {
        if ('admin' != $this->user()?->group->name) {
            header('HTTP/1.0 403 Forbidden');
            echo '403 Forbidden';
            die;
        }

        $groups = $groupStorage->select()->asPairs('name');
        $users = $userStorage->select()->asEntities();
        $this->render('users/list', [
            'users' => $users,
            'groups' => $groups,
        ]);
    }

    #[Route('/update', name: 'update_users')]
    public function update(Request $request, UserStorage $userStorage)
    {
        $users = $request->post('users');
        foreach ($users as $id => $user) {
            $userStorage->updateUser($id, $user['group_id'], $user['is_verified']);
        }

        $this->redirectToRoute('user_list');
    }
}