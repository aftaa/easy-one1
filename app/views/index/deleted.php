<?php

/** @var $entries \app\entities\GuestbookEntry[] */
/** @var $this \easy\MVC\View */
/** @var $count int */
/** @var $page int */
/** @var $limit int */

?>
    <h1 class="deleted-emtries-h1">Deleted guestbook entries</h1>
    <h2>Total count: <?= $count ?></h2>
    <form method="post" action="<?= $this->action('entry_deleted') ?>">
        <input type="hidden" name="page" value="<?= $page ?>">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">author</th>
                <th scope="col">title</th>
                <th scope="col">text</th>
                <th scope="col">created_at</th>
                <th scope="col">deleted_at</th>
                <th scope="col">status</th>
                <th scope="col">user_id</th>
            </tr>
            </thead>
            <?php foreach ($entries as $row): ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $authors[$row->author_id]->name ?></td>
                    <td><a href="<?= $this->href('entry_modify', ['id' => $row->id]) ?>"><?= $row->title ?></a></td>
                    <td><?= $row->text ?></td>
                    <td><?= $row->created_at->format('d.m.Y H:i') ?></td>
                    <td><?= $row->deleted_at?->format('d.m.Y H:i') ?></td>
                    <td><?= $row->status->value ?></td>
                    <td><?= $row->user_id ?></td>
                    <td>
                        <label>
                            <input type="checkbox" name="delete[]" value="<?= $row->id ?>">
                        </label>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <input type="submit" name="submit" value="Restore selected" style="float: right;">
    </form>

<?php for ($i = 1; $i <= ceil($count / $limit); $i++): ?>
    <?php if ($page == $i): ?><b><?php endif ?>
    <a href="<?= $this->href('entry_deleted', ['page' => $i]) ?>">&nbsp;<?= $i ?>&nbsp;</a>
    <?php if ($page == $i): ?></b><?php endif ?>

<?php endfor ?>