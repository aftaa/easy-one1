<?php

namespace easy\helpers;

use app\config\Config;

class QueryTimesItem
{
    private Config $config;

    public function __construct(
        private string $query,
        private array $params = [],
        private float $microtime = 0,
        private string $time = '',
    )
    {
        $this->microtime = microtime(true);
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param int $executionTimePrecision
     * @return void
     */
    public function stop(int $executionTimePrecision): void
    {
        $executionTime = microtime(true) - $this->microtime;
        $executionTime = number_format($executionTime, $executionTimePrecision, '.', ' ');
        $this->time =  $executionTime;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }
}
