<?php
/** @var $this \easy\MVC\View */
/** @var $feedbacks \app\entities\Feedback[] */
?>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>From</th>
        <th>E-mail</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Question date</th>
        <th>Answer date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($feedbacks as $feedback): ?>
        <tr>
            <td><?= $feedback->id ?></td>
            <td><?= $feedback->from ?></td>
            <td><?= $feedback->email ?></td>
            <td><?= $feedback->question ?></td>
            <td><?= $feedback->answer ?></td>
            <td><?= $feedback->question_date->format('d.m.Y H:i:s') ?></td>
            <td><?= $feedback->answer_date?->format('d.m.Y H:i:s') ?></td>
            <td><?= $feedback->status->value ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
