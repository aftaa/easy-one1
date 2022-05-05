<?php
/** @var $this \easy\MVC\View */
/** @var $params array */
/** @var $entry \app\entities\GuestbookEntry */
/** @var $authorName string */
$params['title'] = 'Added record';
?>
<h1>Added record:</h1>
<table class="table">
    <thead>
    <tr>
        <th>Author:</th>
        <th>Title:</th>
        <th>Text:</th>
        <th>Created at:</th>
        <th>Status:</th>
    </tr>
    </thead>
    <tbody>
    <tr class="hover">
        <td><?= $authorName ?></td>
        <td><?= $entry->title ?></td>
        <td><?= $entry->text ?></td>
        <td><?= $entry->created_at->format('d.m.Y H:i:s') ?></td>
        <td><?= $entry->status->value ?></td>
    </tr>
    </tbody>
</table>

<?= $this->link('entry_index', [], 'Show all records') ?>