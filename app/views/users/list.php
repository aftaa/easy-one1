<?php
/** @var \easy\MVC\View $this */
/** @var \app\entities\User[] $users */
/** @var array $groups */
$params['title'] = 'Users';
?>
<h1>Users</h1>
<form method="post" action="<?= $this->action('update_users') ?>">
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Roles</th>
            <th>Recovery</th>
            <th>Register</th>
            <th>Group</th>
            <th>Is verified</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->roles ?></td>
                <td><?= $user->recovery ?></td>
                <td><?= $user->register ?></td>
                <td>
                    <label>
                        <select name="users[<?= $user->id ?>][group_id]">
                            <option value="" <?php if (!$user->group_id) echo ' selected="1"' ?>></option>
                            <?php foreach ($groups as $id => $name): ?>
                                <option value="<?= $id ?>" <?php if ($user->group_id == $id) echo ' selected="1"' ?>>
                                    <?= $name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <select name="users[<?= $user->id ?>][is_verified]">
                            <option value="0" <?php if (!$user->is_verified) echo ' selected="1"' ?>>No</option>
                            <option value="1" <?php if ($user->is_verified) echo ' selected="1"' ?>>Yes</option>
                        </select>
                    </label>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
