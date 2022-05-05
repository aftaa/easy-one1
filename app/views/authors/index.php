<?php
/** @var $authors \app\entities\Author[] */
/** @var $this \easy\MVC\View */
/** @var $entriesNumber array */
/** @var $count int */
/** @var $page int */
/** @var $limit int */
$params['title'] = 'Authors / Page' . $page;
?>

<table class="table table-striped table-light">
    <thead>
    <tr>
        <th>#</th>
        <th>name:</th>
        <th>numbers of entries:</th>
        <th>look the entries:</th>
    </tr>
    </thead>
    <?php foreach ($authors as $id => $author): ?>
    <tr>
        <th>
            <?= $author->id ?>
        </th>
        <td>
            <?= $author->name ?>
        </td>
        <td>
            <?= @$entriesNumber[$id]['count'] ?>
        </td>
        <td>
            <?= $this->link('entry_index', ['authorId' => $author->id], 'look!') ?>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<?php for ($i = 1; $i <= ceil($count / $limit); $i++): ?>
    <?php if ($page == $i): ?><b><?php endif ?>
    <a href="<?= $this->href('authors_index', ['page' => $i]) ?>"><?= $i ?></a>
    <?php if ($page == $i): ?></b><?php endif ?>
<?php endfor ?>

