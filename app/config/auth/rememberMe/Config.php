<?php

namespace app\config\auth\rememberMe;

class Config
{
    public int $expires;

    public function __construct()
    {
        $this->expires = time() + 60 * 60 * 24 * 365;
    }
}
