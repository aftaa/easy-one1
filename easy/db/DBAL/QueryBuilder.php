<?php

namespace easy\db\DBAL;

use function implode;

class QueryBuilder
{
    private string $select = '*';
    private string $from;
    private ?string $where = null;
    private ?string $andWhere = null;
    private ?string $groupBy = null;
    private ?string $having = null;
    private array $orderBy = [];
    private ?int $limit = null;
    private ?int $offset = null;
    private array $params = [];
    private string $entity;
    private ?string $query = '';

    public function __construct(
        private QueryResult $queryResult,
    )
    {
    }

    /**
     * @param string $select
     * @return $this
     */
    public function select(string $select): static
    {
        $this->select = $select;
        return $this;
    }

    /**
     * @param string $from
     * @return $this
     */
    public function from(string $from): static
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param string $where
     * @return $this
     */
    public function where(string $where): static
    {
        $this->where = $where;
        return $this;
    }

    /**
     * @param string $andWhere
     * @return $this
     */
    public function andWhere(string $andWhere): static
    {
        $this->andWhere = $andWhere;
    }

    /**
     * @param string $groupBy
     * @return $this
     */
    public function groupBy(string $groupBy): static
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    /**
     * @param string $having
     * @return $this
     */
    public function having(string $having): static
    {
        $this->having = $having;
        return $this;
    }

    /**
     * @param array $orderBy
     * @return $this
     */
    public function orderBy(array $orderBy): static
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    public function query(string $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function param(string $name, mixed $value): static
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @return QueryResult
     */
    public function getQuery(): QueryResult
    {
        if (!$this->query) {
            $query[] = 'SELECT ' . $this->select . ' FROM `' . $this->from . '`';
            if ($this->where) {
                $query[] = 'WHERE ' . $this->where;
            }
            if ($this->andWhere) {
                $query[] = ' AND ' . $this->andWhere;
            }
            if ($this->groupBy) {
                $query[] = ' GROUP BY ' . $this->groupBy;
            }
            if ($this->having) {
                $query[] = ' HAVING ' . $this->having;
            }
            if ($this->orderBy) {
                $query[] = 'ORDER BY ' . $this->orderBy[0];
                $query[] = match ($this->orderBy[1]) {
                    SORT_DESC => ' DESC ',
                    default => ' ASC ',
                };
            }
            if (null !== $this->limit) {
                $query[] = 'LIMIT ' . $this->limit;
            }
            if (null !== $this->offset) {
                $query[] = 'OFFSET ' . $this->offset;
            }
            $query = implode(' ', $query);
        } else {
            $query = $this->query;
        }
        return $this->queryResult->setEntityName($this->entity)->setQuery($query)->setParams($this->params);
    }

    /**
     * @param string $entity
     * @return $this
     */
    public function entity(string $entity): static
    {
        $this->entity = $entity;
        return $this;
    }
}
