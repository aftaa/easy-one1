<?php
/** @var $this \easy\MVC\Layout */
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Документация' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/easy/site.css" type="text/css">
    <script src="/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/easy/docs.css">
</head>
<body>
<aside class="bg-light">
    <p><strong>Оглавление</strong></p>
    <ul>
        <li><?= $this->link('docs_index', [], 'Установка') ?></li>
        <li><?= $this->link('docs_di', [], 'Dependency Injection') ?></li>
    </ul>
</aside>
<main>
    <?= $this->content ?>
</main>
</body>
</html>
