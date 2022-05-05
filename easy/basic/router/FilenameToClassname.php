<?php

namespace easy\basic\router;

class FilenameToClassname
{
    /**
     * @param string $filename
     * @return string
     */
    public function transform(string $filename): string
    {
        $filename = str_replace('/', '\\', $filename);
        return str_replace('.php', '', $filename);
    }
}
