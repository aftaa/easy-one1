<?php

namespace app\storages;

use easy\db\Storage;

class GroupStorage extends Storage
{
    /**
     * @param string $name
     * @return bool|null
     */
    public function groupNameExists(string $name): ?bool
    {
        return $this->createQueryBuilder()
            ->where('`name` = :name')
            ->param(':name', $name)
            ->getQuery()
            ->getResult()
            ?->exists();
    }
}