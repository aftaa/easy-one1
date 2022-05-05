<?php

namespace easy\db\DBAL;

class RemoveBuilder
{
    protected string $from;
    protected ?string $where = null;
    protected array $orderBy = [];
    protected ?int $limit = null;
    protected array $params = [];

    public function __construct(
        private NoQueryResult $result,
    )
    { }

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
     * @return NoQueryResult
     */
    public function getQuery(): NoQueryResult
    {
        $query[] = 'DELETE FROM `' . $this->from . '`';
        if ($this->where) {
            $query[] = 'WHERE ' . $this->where;
        }
        if ($this->orderBy) {
            $query[] = 'ORDER BY ' . $this->orderBy[0];
            $query[] = match ($this->orderBy[1]) {
                SORT_ASC => ' ASC ',
                default => ' DESC ',
            };
        }
        if (null !== $this->limit) {
            $query[] = 'LIMIT ' .  $this->limit;
        }
        $query = implode(' ', $query);
        return $this->result->query($query)->params($this->params);
    }
}
