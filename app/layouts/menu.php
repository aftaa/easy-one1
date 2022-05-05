<?php
/** @var $this \easy\MVC\View */
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hi!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= $this->href('site_index') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->href('authors_index') ?>">Authors</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Feedback
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ('admin' == $this->user()?->group->name): ?>
                            <li><?= $this->link('feedback_list', [], 'List', ['class' => 'dropdown-item']) ?></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="<?= $this->href('new_feedback') ?>">New</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Guestbook Entries
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><?= $this->link('entry_index', [], 'List', ['class' => 'dropdown-item']) ?></li>
                        <li><a class="dropdown-item" href="<?= $this->href('entry_create') ?>">Create</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><?= $this->link('entry_deleted', [], 'Deleted', ['class' => 'dropdown-item', 'style' => 'color: red;']) ?></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <?= $this->link('show_tables', params: [], label: 'Show Tables', htmlOptions: ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" tabindex="-1" aria-disabled="true"
                       href="<?= $this->href('test_author') ?>">Author test</a>
                </li>
                <li class="nav-item">
                    <?= $this->link('register', [], 'Registration', htmlOptions: ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->link('login', [], 'Login', htmlOptions: ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->link('user_list', [], 'Users', htmlOptions: ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Groups
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><?= $this->link('create_group', [], 'Create', ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->link('group_index', [], 'List', ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </li>
            </ul>
            <!--            <form class="d-flex">-->
            <!--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
            <!--                <button class="btn btn-outline-success" type="submit">Search</button>-->
            <!--            </form>-->

            <?php if (!$this->user()): ?>
                <form method="post" class="d-flex" action="<?= $this->action('login') ?>">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">E-mail:</span>
                        <input required type="email" class="form-control" name="email">
                        <span class="input-group-text">Password</span>
                        <input required type="password" class="form-control" name="password">
                        <input type="submit" value="Login" name="login" class="btn btn-outline-secondary">
                    </div>
                </form>
            <?php else: ?>
                <div>
                    Hi, <?= $this->user()->username ?> (<?= $this->user()->email ?>)
                    | <?= $this->link('logout', [], 'Logout') ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</nav>