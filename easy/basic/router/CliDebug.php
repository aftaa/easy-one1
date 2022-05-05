<?php

namespace easy\basic\router;

trait CliDebug
{
    /**
     * @return void
     */
    public function cli_debug(): void
    {
        /** @var $byPath Routing[] */
        $byPath = $this->byPath;

        foreach ($byPath as $routing) {
            echo $routing->path;
            echo ' -> ';
            echo '"' . $routing->name . '"';
            echo '   (' .  $routing->action . '@' . str_replace('app\controllers\\', '', $routing->controller) . ')';
            echo "\n";
            echo "\n";
        }
    }
}