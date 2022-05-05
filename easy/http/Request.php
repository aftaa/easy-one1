<?php

namespace easy\http;

class Request
{
    /**
     * @param string $name
     * @return string|null
     */
    public function get(string $name): ?string
    {
        return $_GET[$name] ?? null;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function post(string $name): ?string
    {
        return $_POST[$name] ?? null;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function query(string $name): ?string
    {
        return $_REQUEST[$name] ?? null;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return !empty($_POST);
    }
}
