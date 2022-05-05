<?php

/** @var $this \easy\MVC\View */
/** @var $tableName string */
/** @var $columns array */

?>

<h1>Columns for table symfony.<?= $tableName ?>:</h1>

<table class="table">
    <thead>
    <tr>
        <th>Field</th>
        <th>Type</th>
        <th>Null</th>
        <th>Key</th>
        <th>Default</th>
        <th>Extra</th>
    </tr>
    </thead>
    </thead>
    <tbody>
    <?php foreach ($columns as $col): ?>
        <tr>
            <td><?= $col['Field'] ?></td>
            <td><?= $col['Type'] ?></td>
            <td><?= $col['Null'] ?></td>
            <td><?= $col['Key'] ?></td>
            <td><?= $col['Default'] ?></td>
            <td><?= $col['Extra'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>