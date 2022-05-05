<?php

namespace easy\http;

class Session
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function set(string $key, mixed $data)
    {
        $_SESSION[$key] = $data;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return void
     */
    public function del(string $key): void
    {
        unset($_SESSION[$key]);
    }
}
