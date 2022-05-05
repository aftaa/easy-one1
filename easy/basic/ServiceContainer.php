<?php

namespace easy\basic;

use easy\Application;

class ServiceContainer
{
    private array $container = [];

    /**
     * @param string $classname
     * @return bool
     */
    public function has(string $classname): bool
    {
        return isset($this->container[$classname]);
    }

    /**
     * @param string $classname
     * @return object|null
     */
    public function get(string $classname): ?object
    {
        return $this->container[$classname];
    }

    /**
     * @param object $object
     * @return void
     */
    public function add(object $object): void
    {
        $classname = get_class($object);
        $this->container[$classname] = $object;
    }

    /**
     * @param string $classname
     * @return object|null
     */
    public function init(string $classname): ?object
    {
        if ($this->has($classname)) {
            return $this->get($classname);
        }
        return $this->get(DependencyInjection::class)->make($classname);
    }

    /**
     * @return array
     */
    public function getInstances(): array
    {
        return $this->container;
    }
}
