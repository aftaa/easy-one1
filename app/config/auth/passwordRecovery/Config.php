<?php

namespace app\config\auth\passwordRecovery;

class Config
{
    public string $url = 'http://easy-one/reset?code=';

    public function __construct()
    {
        $this->url = "http://$_SERVER[SERVER_NAME]/reset?code=";
    }


}