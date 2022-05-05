<?php

namespace easy\MVC;

use app\config\MVC\Layout\Config;
use easy\http\Session;

class Layout
{
    use ViewLayoutTrait;

    /**
     * @var string
     */
    public string $content;

    /**
     * @param Config $config
     * @param Session $session
     */
    public function __construct(
        private Config  $config,
        private Session $session,
    )
    {
    }

    /**
     * @param string|null $filename
     * @param array|null $params
     * @return void
     */
    public function render(?string $filename = null, ?array $params = []): void
    {
        if (null === $filename) {
            $filename = $this->config->defaultLayout;
        }
        $filename = 'app/layouts/' . $filename . '.php';
        if (!file_exists($filename)) {
            throw new \LogicException("Layout file $filename not found.");
        }
        extract($params);
        require_once $filename;
    }
}
