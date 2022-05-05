<?php

namespace app\controllers;

use app\entities\Group;
use app\services\GroupService;
use app\storages\GroupStorage;
use easy\basic\router\Route;
use easy\http\Request;
use easy\MVC\Controller;

#[Route('/groups')]
class GroupController extends Controller
{
    #[Route('', name: 'group_index')]
    public function index(GroupStorage $storage)
    {
        $this->render('groups/index', [
            'groups' => $storage->select()->asEntities(),
        ]);
    }

    #[Route('/create', name: 'create_group')]
    public function create(Request $request, GroupStorage $storage)
    {
        if ('admin' != $this->user()?->group->name) {
            $this->render('errors/403');
        } else {
            if ($request->isPost()) {
                try {
                    $name = $request->query('name');
                    $group = new Group();
                    $group->name = $name;
                    if ($storage->groupNameExists($name)) {
                        throw new \Exception('Group with this name is exists');
                    }
                    $storage->store($group);
                    $this->redirectToRoute('group_index');
                } catch (\Exception $e) {
                    $errorMessage = $e->getMessage();
                }
            }
            $this->render('groups/create', [
                'name' => $name ?? '',
                'errorMessage' => $errorMessage ?? '',
            ]);
        }
    }

    #[Route('/delete', name: 'delete_groups')]
    public function delete(Request $request, GroupService $service)
    {
        if ($request->isPost() && $request->query('delete')) {
            $service->deleteGroups($request->query('delete'));
        }
        $this->back();
    }
}