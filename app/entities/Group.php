<?php

namespace app\entities;

use easy\db\ORM\Entity;

class Group extends Entity
{
    public ?int $id = null;
    public string $name;
}
