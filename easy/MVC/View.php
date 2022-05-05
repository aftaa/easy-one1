<?php

namespace easy\MVC;

use easy\Application;
use easy\auth\UserTrait;
use easy\basic\Router;
use easy\http\Session;

class View
{
    use ViewLayoutTrait;

    /**
     * //TODO
     * @var string|null Если не null, easy попытается использовать данный шаблон
     */
    public ?string $layout = null;

    /**
     * //TODO
     * Заполняется внутри шаблона для макета
     */
    public array $params = [];

    /**
     * @param Session $session
     */
    public function __construct(
        private Session $session
    )
    {
    }


    /**
     * @param string $filename
     * @param array $params
     * @return string|false
     */
    public function render(string $filename, array $params = []): string|false
    {
        $filename = 'app/views/' . $filename . '.php';
        extract($params);
        $params =& $this->params;
        ob_start();
        require_once $filename;
        return ob_get_clean();
    }
}
