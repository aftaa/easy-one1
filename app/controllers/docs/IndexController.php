<?php

namespace app\controllers\docs;

use easy\basic\router\Route;
use easy\MVC\Controller;

#[Route('/docs/')]
class IndexController extends Controller
{
    #[Route('', name: 'docs_index')]
    public function index()
    {
        $this->render('docs/index');
    }

    #[Route('dependency_injection/', name: 'docs_di')]
    public function dependencyInjection()
    {
        $this->render('docs/dependency_injection');
    }
}
