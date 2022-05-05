<?php
/** @var \easy\MVC\View $this */
/** @var string $login */
/** @var string $password */
/** @var string $errorMessage */
?>

<h1>Authentication</h1>

<div style="margin: 0 auto; width: 500px;">
<!--    <div class="alert alert-danger" role="alert">Login/password incorrect</div>-->
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
    <?php endif ?>
    <form method="post" action="<?= $this->action('login') ?>">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" value="<?= $this->escape($email ?? '') ?>" required name="email">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" value="<?= $this->escape($password ?? '') ?>" required name="password">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <div class="form-check">
                    <input name="remember_me" class="form-check-input" type="checkbox" id="remember_me" value="1">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Login">
        or <?= $this->link(name: 'recovery', label: 'recovery my password', params: ['email' => $email]) ?>
    </form>
</div>