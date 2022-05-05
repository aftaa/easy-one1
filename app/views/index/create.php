<?php

/** @var $this \easy\MVC\View */
/** @var $cases array */

?>
<?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$errorMessage?>
    </div>
<?php endif ?>
<form method="post" action="<?= $this->action('entry_create') ?>">
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Text</label>
        <textarea class="form-control" id="text" name="text"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create an entry</button>
</form>