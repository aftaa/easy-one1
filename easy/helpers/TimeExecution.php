<?php

namespace easy\helpers;

use app\config\Config;

class TimeExecution
{
    public function __construct(private Config $config)
    {
        $this->microtime = microtime(true);
    }

    /**
     * @return float
     */
    public function stop(): float
    {
        $executionTime = microtime(true) - $this->microtime;
        $executionTime = number_format($executionTime, $this->config->executionTimePrecision, '.', ' ');
        return $executionTime;
    }
}
