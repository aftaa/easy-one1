<?php

/** @var $tables array */
/** @var $this \easy\MVC\View */

?>

<table class="table">
    <?php foreach ($tables as $table): extract($table) ?>
    <tr>
        <td><?= $Tables_in_symfony ?></td>
        <td><?= $this->link('show_columns', ['tableName' => $Tables_in_symfony]) ?></td>
    </tr>
    <?php endforeach ?>
</table>
