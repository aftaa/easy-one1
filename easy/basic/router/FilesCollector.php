<?php

namespace easy\basic\router;

class FilesCollector
{
    /**
     * @param string $folder
     * @return array
     */
    public function collect(string $folder = 'app/controllers'): array
    {
        static $paths = [];
        foreach (glob("$folder/*.php") as $php) {
            $paths[] = $php;
        }
        $folders = glob("$folder/*", GLOB_ONLYDIR);
        foreach ($folders as $folder) {
            $this->collect($folder);
        }
        return $paths;
    }
}