<?php
/** @var \easy\MVC\View $this */
/** @var string $error */
/** @var string $email */
$params['title'] = 'Reset password';
?>
<h1>Reset password</h1>
<div style="margin: 0 auto; width: 500px;">

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif ?>

    <div class="alert alert-success" role="alert">Enter your new password:</div>
    <form method="post" action="<?= $this->action('reset') ?>">
        <input type="hidden" name="code" value="<?= $code ?>">
        <div class="row mb-3">
            <label for="password1" class="col-sm-2 col-form-label">Password:</label>
            <div class="col-sm-10">
                <input name="password1" type="password" class="form-control" id="password1" required>
            </div>
            <br><br>
            <label for="password2" class="col-sm-2 col-form-label">Re-type:</label>
            <div class="col-sm-10">
                <input name="password2" type="password" class="form-control" id="password2" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Set up</button>
    </form>
</div>
