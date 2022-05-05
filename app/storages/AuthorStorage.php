<?php

namespace app\storages;

use app\entities\Author;
use app\entities\GuestbookEntry;
use easy\db\ORM\Entity;
use easy\db\Storage;

class AuthorStorage extends Storage
{
    /**
     * @return Author[]
     * @throws \Exception
     */
    public function selectPage(int $page): array
    {
        return $this->createQueryBuilder()
            ->limit(10)
            ->offset(($page - 1) * 10)
            ->orderBy(['name', SORT_ASC])
            ->getQuery()
            ->getResults()
            ->asEntities();
    }

    public function count()
    {
        return $this->createQueryBuilder()
            ->select('COUNT(*) as count')
            ->getQuery()
            ->getResult()
            ->asArray()['count'];
    }

    /**
     * @param string $author
     * @return Entity|null
     */
    public function searchByName(string $author): ?Entity
    {
        return $this->createQueryBuilder()
            ->where('name = :author')
            ->param(':author', $author)
            ->getQuery()
            ->getResult()?->asEntity();
    }
}
