<?php

namespace easy\basic\router;

use easy\basic\Router;

trait HtmlDebug
{
    public function debug()
    {
        /** @var $byPath Routing[] */
        $byPath = $this->byPath;
        ?><table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Path</th>
                <th>Controller</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($byPath as $path => $routing): ?>
                <tr>
                    <td><?= $routing->name ?></td>
                    <td><?= $routing->path ?></td>
                    <td><?= str_replace('app\controllers\\', '', $routing->controller) ?></td>
                    <td><?= $routing->action ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <?php
    }
}
