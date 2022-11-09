<?php

namespace easy\db;

use app\config\db\connection\Config;

class Connection
{
    private \PDO $PDO;

    /**
     * @param Config $config
     */
    public function __construct(
        private Config $config,
    )
    {
        $this->connect($this->config);
    }

    /**
     * @param Config $config
     * @return void
     */
    private function connect(Config $config)
    {
        $this->PDO = new \PDO("{$config->provider}:host={$config->hostname};dbname={$config->database};port={$config->port}", $config->username, $config->password);
    }

    /**
     * @return \PDO
     */
    public function get()
    {
        return $this->PDO;
    }
}
