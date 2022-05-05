<?php

namespace app\controllers;

use app\entities\Author;
use app\storages\AuthorStorage;
use app\storages\GuestbookEntryStorage;
use easy\basic\router\Route;
use easy\db\Connection;
use easy\http\Request;
use easy\MVC\Controller;

#[Route('/authors')]
class AuthorController extends Controller
{
    /**
     * @throws \ReflectionException
     * @throws \Throwable
     */
    #[Route('', name: 'authors_index')]
    public function index(AuthorStorage $authorStorage, GuestbookEntryStorage $entryStorage, Request $request)
    {
        $authors = $authorStorage->selectPage($request->query('page') ?? 1);
        $entriesNumber = $entryStorage->entriesNumberByAuthorId();

        $this->render('authors/index', [
            'authors' => $authors,
            'entriesNumber' => $entriesNumber,
            'count' => $authorStorage->count(),
            'page' => $request->query('page') ?? 1,
            'limit' => 10,
        ]);
    }

    #[Route('/test', name: "test_author")]
    public function authorTest()
    {

    }
}