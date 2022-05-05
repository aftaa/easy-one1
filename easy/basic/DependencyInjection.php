<?php

namespace easy\basic;

use app\config\basic\dependencyInjection\Config;
use easy\basic\startup\Turn;

class DependencyInjection
{
    /**
     * @param Config $config
     * @param ServiceContainer $serviceContainer
     */
    public function __construct(
        private Config $config,
        private ServiceContainer $serviceContainer,
    )
    { }

    /**
     * @param string $classname
     * @return object
     * @throws \ReflectionException
     */
    public function make(string $classname): object
    {
//        echo $classname, '<br>';
        if (Turn::ON === $this->config->useServiceContainer && $this->serviceContainer->has($classname)) {
            return $this->serviceContainer->get($classname);
        }

        $class = new \ReflectionClass($classname);
        $constructor = $class->getConstructor();

        $arguments = $parameters = [];
        if ($constructor) {
            $parameters = $constructor->getParameters();
        }

        foreach ($parameters as $parameter) {
            $typename = $parameter->getType()->getName();
            $arguments[] = $this->make($typename);
        }
        $object = $class->newInstance(...$arguments);

        if (Turn::ON === $this->config->useServiceContainer) {
            $this->serviceContainer->add($object);
        }
        return $object;
    }
}
