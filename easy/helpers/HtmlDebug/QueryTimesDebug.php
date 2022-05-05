<?php

namespace easy\helpers\HtmlDebug;

trait QueryTimesDebug
{
    public function debug()
    {
        /** @var \easy\helpers\QueryTimes $queryTimes */
        $queryTimes = \easy\Application::$serviceContainer->get(\easy\helpers\QueryTimes::class);
        if ($queryTimes) {
            ?>
            <h4>Queries: <?= count($queryTimes->get()) ?> in <?= $queryTimes->timeSum ?>sec.</h4>
            <table class="table">
                <thead>
                <tr>
                    <th>Query</th>
                    <th>Params</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($queryTimes->get() as $item): /** @var $item \easy\helpers\QueryTimesItem */ ?>
                    <tr>
                        <td><?= $item->getSQL() ?></td>
                        <td>
                            <?php foreach ($item->getParams() as $name => $value): ?>
                                [<?= $name ?> => <?= $value ?>]
                            <?php endforeach ?>
                        </td>
                        <td><?= $item->getTime() ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php } else {
            echo 'No queries yet';
        }
    }
}