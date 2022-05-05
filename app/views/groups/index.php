<?php
/** @var $groups \app\entities\Group[] */
/** @var $errorMessage string */
?>

<h1>Groups</h1>
<form method="post" action="<?= $this->action('delete_groups') ?>">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($groups as $group): ?>
            <tr>
                <td>
                    <?= $group->name ?>
                </td>
                <td align="right">
                    <label>
                        <input type="checkbox" name="delete[]" value="<?= $group->id ?>">
                    </label>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <input type="submit" name="submit" value="Delete" class="btn btn-danger" style="float: right;">
</form>