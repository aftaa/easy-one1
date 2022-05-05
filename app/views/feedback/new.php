<?php
/** @var \easy\MVC\View $this */
/** @var array $params */
?>

<h1>Create a feedback:</h1>
<?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$errorMessage?>
    </div>
<?php endif ?>
<form method="post" action="<?= $this->action('new_feedback') ?>">
    <div class="mb-3">
        <label for="from" class="form-label">From: </label>
        <input type="text" class="form-control" id="from" name="from">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail: </label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="question" class="form-label">Your question: </label>
        <textarea class="form-control" id="question" name="question"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create a feedback</button>
</form>