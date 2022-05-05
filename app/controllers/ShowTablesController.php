<?php

namespace app\controllers;

use app\storages\AuthorStorage;
use app\storages\ShowTablesStorage;
use easy\basic\router\Route;
use easy\db\Storage;
use easy\http\Request;

#[Route('/tables')]
class ShowTablesController extends \easy\MVC\Controller
{
    /**
     * @throws \Throwable
     */
    #[Route('/show', name: 'show_tables')]
    public function showTables(ShowTablesStorage $storage)
    {
        $tables = $storage->showTables();
        $this->render('show/tables', [
            'tables' => $tables,
        ]);
    }

    #[Route('/columns', name: 'show_columns')]
    public function showColumns(Request $request, ShowTablesStorage $storage)
    {
        $tableName = $request->get('tableName');
        $columns = $storage->showColumns($tableName);
        $this->render('show/columns', [
            'tableName' => $tableName,
            'columns' => $columns,
        ]);
    }
}