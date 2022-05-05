<?php

namespace easy\basic;

use easy\basic\router\HtmlDebug;
use easy\basic\router\CliDebug;
use easy\basic\router\Routing;
use easy\basic\router\RoutesCollector;
use easy\basic\router\FilesCollector;

class Router
{
    use HtmlDebug;
    use CliDebug;

    /** @var Routing[] */
    protected array $byName = [];

    /** @var Routing[] */
    protected array $byPath = [];

    /** @var Routing  */
    protected Routing $actual;

    /**
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $controllerFiles = (new FilesCollector())->collect();
        $routes = (new RoutesCollector())->collect($controllerFiles);
        $this->byPath = $routes->routesByPath;
        $this->byName = $routes->routesByName;
    }

    /**
     * @return Routing|null
     */
    public function findControllerActionByRequestUri(): ?Routing
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = parse_url($path, PHP_URL_PATH);
        if (isset($this->byPath[$path])) {
            $this->actual = $this->byPath[$path];
            return $this->byPath[$path];
        }
        return null;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function findPathByName(string $name): ?string
    {
        if (isset($this->byName[$name])) {
            return $this->byName[$name]->path;
        }
        return null;
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \Exception
     */
    public function route(string $name, array $params = []): string
    {
        $params = http_build_query($params);
        $path = $this->findPathByName($name);
        if ($params) {
            $path = "$path?$params";
        }
        if (null === $path) {
            throw new \Exception('">Не найден маршрут ' . $name);
        }
        return $path;
    }

    /**
     * @return Routing
     */
    public function actual(): Routing
    {
        return $this->actual;
    }
}
