<?php

namespace app\entities;

use easy\db\ORM\Entity;

class User extends Entity
{
    public ?int $id = null;
    public string $username;
    public string $email;
    public bool $is_verified;
    public string $roles;
    public string $password;
    public ?int $group_id = null;
    public ?string $recovery = null;
    public ?string $register = null;

    public ?Group $group = null;
}
