<?php

namespace easy\db\DBAL;

use easy\db\Connection;
use easy\helpers\QueryTimes;

class NoQueryResult
{
    private string $query;
    private array $params;

    public function __construct(
        private Connection $connection,
        private QueryTimes $queryTimes,
    )
    { }

    /**
     * @param string $query
     * @return $this
     */
    public function query(string $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function params(array $params = []): static
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return bool
     */
    public function getResult(): bool
    {
        $this->queryTimes->start($this->query, $this->params);
        $result = $this->connection->get()->prepare($this->query)->execute($this->params);
        $this->queryTimes->stop();
        return $result;
    }
}
