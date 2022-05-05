<?php

namespace easy\basic\router;

class RoutesCollector
{
    /**
     * @param array $files
     * @return CollectedRoutes
     * @throws \ReflectionException
     */
    public function collect(array $files): CollectedRoutes
    {
        $byName = $byPath = [];
        $fileNameToClassName = new FilenameToClassname();
        foreach ($files as $file) {
            $class = $fileNameToClassName->transform($file);
            $reflection = new \ReflectionClass($class);

            $pathPrefix = '';
            $attributes = $reflection->getAttributes(Route::class);
            foreach ($attributes as $attribute) {
                $arguments = $attribute->getArguments();
                $path = $arguments[0];
                $pathPrefix = $path;
            }

            foreach ($reflection->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);
                foreach ($attributes as $attribute) {
                    $arguments = $attribute->getArguments();
                    $name = @$arguments['name'];
                    $path = $arguments[0];
                    if ($pathPrefix) {
                        $path = $pathPrefix . $path;
                    }
                    $routing = new Routing($class, $method->name, $name, $path);
                    if ($name) {
                        $byName[$name] = $routing;
                    }
                    $byPath[$path] = $routing;
                }
            }
        }
        return new CollectedRoutes($byName, $byPath);
    }
}
