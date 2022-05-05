<?php

namespace app\config\db\transaction;

class Config
{
    // TODO до первого вызова объекта транзакции транзакции будут заканчиваться автоматически
    public bool $autoCommit = false;
}