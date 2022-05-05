<?php
?>
<h1>Create User</h1>
<div style="margin: 0 auto; width: 500px;">
    <?php if (@$errorMessage): ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
    <?php endif ?>
    <?php if (@$done): ?>
        <div class="alert alert-success" role="alert">Please check your e-mail for activate user record</div>
    <?php endif ?>
    <form method="post" action="<?= $this->action('create_group') ?>">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" value="<?= $this->escape($name ?? '') ?>" required name="name">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>