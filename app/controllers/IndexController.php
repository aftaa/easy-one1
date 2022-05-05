<?php

namespace app\controllers;

use app\entities\Author;
use app\entities\GuestbookEntry;
use app\entities\GuestbookEntryStatus;
use app\storages\AuthorStorage;
use app\storages\GuestbookEntryStorage;
use easy\basic\router\Route;
use easy\db\Transaction;
use easy\http\Request;
use easy\MVC\Controller;

#[Route('/')]
class IndexController extends Controller
{
    #[Route('', name: 'site_index')]
    public function index()
    {
        $this->render('index/site', []);
    }

    /**
     * @throws \Throwable
     */
    #[Route('test1', name: 'entry_index')]
    public function entryIndex(GuestbookEntryStorage $storage, Request $request, AuthorStorage $authorStorage)
    {
        if ($request->isPost() && ($deleted = $request->query('delete'))) {
            foreach ($deleted as $id) {
                $storage->softDelete($id);
            }
        }
        $authorId = $request->query('authorId');
        $page = $request->query('page') ?? 1;
        $all = $storage->selectPage($page, $authorId);
        $count = $storage->selectCount($authorId);
        $this->render('index/index', [
            'all' => $all,
            'count' => $count,
            'page' => $page,
            'limit' => 10,
            'authors' => $authorStorage->select()->asEntities(),
        ]);
    }

    /**
     * @throws \Throwable
     */
    #[Route('deleted', name: 'entry_deleted')]
    public function deleted(Request $request, GuestbookEntryStorage $storage, AuthorStorage $authorStorage)
    {
        if ($request->isPost() && ($deleted = $request->query('delete'))) {
            foreach ($deleted as $id) {
                $storage->restore($id);
            }
        }

        $page = $request->query('page') ?? 1;
        $entries = $storage->getDeletedEntries($page);
        $count = $storage->deletedCount();
        $this->render('index/deleted', [
            'entries' => $entries,
            'count' => $count,
            'page' => $page,
            'limit' => 10,
            'authors' => $authorStorage->select()->asEntities(),
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('modify', name: 'entry_modify')]
    public function modify(GuestbookEntryStorage $storage, Request $request, AuthorStorage $authorStorage)
    {
//        $statusCases = GuestbookEntryStatus::c();
        $entry = $storage->load($request->query('id'))->asEntity();

        $authors = $authorStorage->select()->asEntities();

        if ($request->isPost()) {
            $entry->author_id = $request->post('author_id');
            $entry->title = $request->post('title');
            $entry->text = $request->post('text');
            $entry->status = GuestbookEntryStatus::from($request->post('status'));
            $storage->store($entry);
        }

        $this->render('index/modify', [
            'entry' => $entry,
            'statusCases' => GuestbookEntryStatus::class,
            'authors' => $authors,
        ]);
    }

    /**
     * @throws \ReflectionException
     * @throws \Throwable
     */
    #[Route('create', name: 'entry_create')]
    public function create(Request $request, GuestbookEntryStorage $storage, AuthorStorage $authorStorage, Transaction $transaction)
    {
        $errorMessage = '';
        if ($request->isPost()) {
            try {
                $transaction->begin();
                $entry = new GuestbookEntry();
                $authorName = $request->post('author');
                $author = $authorStorage->searchByName($authorName);
                if (!$author) {
                    $author = new Author();
                    if (empty($authorName)) {
                        throw new \Exception("All fields as required");
                    }
                    $author->name = $authorName;
                    $entry->author_id = $authorStorage->store($author);
                } else {
                    $entry->author_id = $author->id;
                }
                $entry->title = $request->post('title');
                $entry->text = $request->post('text');

                if (!strlen($entry->title) || !strlen($entry->text)) {
                    throw new \Exception("All fields as required");
                }

                $entry->created_at = new \DateTime();
                $entry->status = GuestbookEntryStatus::VERIFIED;
                $id = $storage->store($entry);
                $transaction->commit();

                $this->redirectToRoute('entry_created', ['id' => $id]);

            } catch (\Exception $e) {
                $transaction->rollback();
                $errorMessage = $e->getMessage();
            }
        }

        $this->render('index/create', [
            'statusCases' => GuestbookEntryStatus::cases(),
            'errorMessage' => $errorMessage,
        ]);
    }

    #[Route('done', name: 'entry_created')]
    public function done(AuthorStorage $authorStorage, GuestbookEntryStorage $storage, Request $request)
    {
        /** @var GuestbookEntry $entry */
        $entry = $storage->load($request->query('id'))->asEntity();
        $authorName = $authorStorage->load($entry->author_id)->asEntity()->name;
        $this->render('index/done', [
            'entry' => $entry,
            'authorName' => $authorName
        ]);
    }
}
