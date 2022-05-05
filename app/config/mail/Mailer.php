<?php

use easy\mail\EmailAddress;

class Mailer
{
    public function __construct(
        public string $from = 'no-reply@localhost',
    )
    {
    }
}