<?php

namespace easy\auth;

class PasswordHash
{
    public function makeHash(string $password): string
    {
        return md5($password);
    }
}