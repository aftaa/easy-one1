<?php

/** @var $entry \app\entities\GuestbookEntry */
/** @var $this \easy\MVC\View */

/** @var $statusCases GuestbookEntryStatus */
/** @var $authors \app\entities\Author[] */

use app\entities\GuestbookEntryStatus;

$this->params['title'] = 'modify-test';
?>
<h1>ID #<?= $entry->id ?></h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $entry->id ?>">
    <table class="table">
        <tr>
            <td>Author:</td>
            <td>
                <label>
                    <select name="author_id">
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->id ?>" <?php if ($author->id == $entry->author_id) echo ' selected="1"' ?>>
                                <?= $author->name ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="<?= $this->escape($entry->title) ?>"></td>
        </tr>
        <tr>
            <td>Text:</td>
            <td><input type="text" name="text" value="<?= $this->escape($entry->text) ?>"></td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="status">
                    <?php foreach ($statusCases::cases() as $statusCase): ?>
                        <option value="<?= $statusCase->value ?>"<?php
                        if ($statusCase == $entry->status) echo ' selected="1"'
                        ?>><?= $statusCase->name ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" name="store" value="store">
</form>