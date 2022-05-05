<?php

namespace easy\MVC;

use app\entities\User;
use easy\Application;
use easy\auth\Authenticate;
use easy\basic\Router;

trait ViewLayoutTrait
{
    /**
     * @param string $string
     * @param $flags
     * @param string|null $encoding
     * @param bool $double_encode
     * @return string
     */
    public function escape(string $string, $flags = ENT_QUOTES|ENT_SUBSTITUTE, ?string $encoding = 'UTF-8', bool $double_encode = true): string
    {
        return htmlspecialchars($string, $flags, $encoding, $double_encode);
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \Exception
     */
    public function href(string $name, array $params = []): string
    {
        /** @var Router $router */
        $router = Application::$serviceContainer->get(Router::class);
        return $router->route($name, $params);
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \Exception
     */
    public function action(string $name, array $params = []): string
    {
        return $this->href($name, $params);
    }

    /**
     * @param array|null $htmlOptions
     * @return string
     */
    private function linkHtmlOptionsToHtml(?array $htmlOptions): string
    {
        $html = [];
        if ($htmlOptions) {
            foreach ($htmlOptions as $option => $value) {
                $value = $this->escape($value);
                $html[] = " $option=\"$value\"";
            }
        }
        $html = join(' ', $html);
        $html = rtrim($html);
        return $html;
    }

    /**
     * @param string $name
     * @param array $params
     * @param string|null $label
     * @param array|null $htmlOptions
     * @return string
     * @throws \Exception
     */
    public function link(string $name, array $params = [], ?string $label = null, ?array $htmlOptions = []): string
    {
        $label = $label ?: $name;
        $href = $this->href($name, $params);
        $attr = $this->linkHtmlOptionsToHtml($htmlOptions);
        return "<a href=\"$href\"$attr>$label</a>";
    }

    /**
     * @return string
     */
    private function partialGetDir(): string
    {
        switch (get_class($this)) {
            case View::class:
                return 'app/views';
            case Layout::class:
                return 'app/layouts';
        }
    }

    /**
     * @param string $filename
     * @param array $params
     * @return void
     */
    public function partial(string $filename, array $params = [])
    {
        $dir = $this->partialGetDir();
        extract($params);
        require_once "$dir/$filename.php";
    }


    /**
     * @return User|null
     */
    public function user(): ?User
    {
        if ($this->session->has(Authenticate::class)) {
            return $this->session->get(Authenticate::class);
        }
        return null;
    }
}
