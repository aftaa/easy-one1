<?php
/** @var \easy\MVC\View $this */
/** @var string $error */
/** @var string $email */
/** @var bool $done */
$params['title'] = 'Recovery password';
?>

<h1>Recovery password</h1>


<div style="margin: 0 auto; width: 500px;">

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif ?>

    <?php if ($done): ?>
        <div class="alert alert-success" role="alert">Check your mail</div>
    <?php endif ?>


    <div class="alert alert-success" role="alert">Enter your email:</div>
    <form method="post" action="<?= $this->action('recovery') ?>">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input name="email" type="email" class="form-control" id="inputEmail3" required value="<?= $this->escape($email ?? '') ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Recovery</button>
    </form>
</div>