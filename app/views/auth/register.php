<?php
/** @var $this \easy\MVC\View */
/** @var $errorMessage string */
/** @var $done bool */
/** @var $email string */
/** @var $username string */
?>

<h1>Registration</h1>

<div style="margin: 0 auto; width: 500px;">
    <?php if (@$errorMessage): ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
    <?php endif ?>
    <?php if (@$done): ?>
        <div class="alert alert-success" role="alert">Please check your e-mail for activate user record</div>
    <?php endif ?>
    <form method="post" action="<?= $this->action('register') ?>">
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" value="<?= $this->escape($email ?? '') ?>" required name="email">
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" value="<?= $this->escape($username ?? '') ?>" required name="username">
            </div>
        </div>
        <div class="row mb-3">
            <label for="password1" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password1" value="" required name="password1">
            </div>
        </div>
        <div class="row mb-3">
            <label for="password2" class="col-sm-2 col-form-label">Re-type</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password2" value="" required name="password2">
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>