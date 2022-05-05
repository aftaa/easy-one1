<?php

namespace easy\mail;

class EmailBody
{
    public function __construct(
        public string $text,
        public ?string $html = '',
    )
    {
    }
}
