<?php

namespace app\storages;

use easy\db\Storage;

class ShowTablesStorage extends Storage
{
    /**
     * @return array
     */
    public function showTables(): array
    {
        return $this->createQueryBuilder()
            ->query('SHOW TABLES')
            ->getQuery()
            ->getResults()
            ->asArray();
    }


    /**
     * @param string $tableName
     * @return array
     */
    public function showColumns(string $tableName): array
    {
        return $this->createQueryBuilder()
            ->query('SHOW COLUMNS FROM `' . $tableName . '`')
            ->getQuery()
            ->getResults()
            ->asArray();
    }
}