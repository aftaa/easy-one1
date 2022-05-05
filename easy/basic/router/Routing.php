<?php

namespace easy\basic\router;

class Routing
{
    public function __construct(
        public string $controller,
        public string $action,
        public ?string $name = null,
        public ?string $path = null,
    )
    { }
}
