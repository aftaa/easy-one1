<?php

namespace easy\db\DBAL;

use easy\db\Connection;
use easy\db\ORM\ArrayToEntity;
use easy\db\ORM\Entity;
use easy\helpers\QueryTimes;

use function count;

class QueryResult
{
    private string $query;
    private string $entityName;
    private array $params;
    private array $data;

    /**
     * @param Connection $connection
     * @param ArrayToEntity $arrayToEntity
     * @param QueryTimes $queryTimes
     */
    public function __construct(
        private Connection $connection,
        private ArrayToEntity $arrayToEntity,
        private QueryTimes $queryTimes,
    )
    { }

    /**
     * @param string $query
     * @return $this
     */
    public function setQuery(string $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $entity
     * @return $this
     */
    public function setEntityName(string $entity): static
    {
        $this->entityName = $entity;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): static
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return $this|null
     */
    public function getResult(): ?static
    {
        $this->queryTimes->start($this->query, $this->params);
        $stmt = $this->connection->get()->prepare($this->query);
        $stmt->execute($this->params);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->queryTimes->stop();
        if (false === $data) {
            return null;
        } else {
            $this->data = $data;
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function getResults(): static
    {
        $this->queryTimes->start($this->query, $this->params);
        $stmt = $this->connection->get()->prepare($this->query);
        $stmt->execute($this->params);
        $this->data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->queryTimes->stop();
        return $this;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->data;
    }

    /**
     * @param string|null $key
     * @return array
     * @throws \Exception
     */
    public function asEntities(?string $key = null): array
    {
        $key = $key ?: 'id';
        $entities = [];
        foreach ($this->data as $row) {
            $entities[$row[$key]] = $this->arrayToEntity->transform($this->entityName, $row);
        }
        return $entities;
    }

    /**
     * @return Entity
     * @throws \Exception
     */
    public function asEntity(): Entity
    {
        return $this->arrayToEntity->transform($this->entityName, $this->data);
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function asArrays(?string $key): array
    {
        $key = $key ?: 'id';
        $array = [];
        foreach ($this->data as $row) {
            $array[$row[$key]] = $row;
        }
        return $array;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return (bool)$this->count();
    }

    /**
     * @param string $value
     * @param string $key
     * @return array
     */
    public function asPairs(string $value, string $key = 'id'): array
    {
        $array = [];
        foreach ($this->data as $datum) {
            $array[$datum[$key]] = $datum[$value];
        }
        return $array;
    }
}
