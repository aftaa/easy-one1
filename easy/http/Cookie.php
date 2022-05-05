<?php

namespace easy\http;

class Cookie
{
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return $_COOKIE[$name];
    }

    /**
     * @param string $name
     * @param string $value
     * @param int $expires
     * @return bool
     */
    public function set(string $name, string $value, int $expires = 0): bool
    {
        return setcookie($name, $value, $expires, '/', $_SERVER['SERVER_NAME']);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function del(string $name): bool
    {
        return setcookie($name, '', time() - 3600);
    }
}
