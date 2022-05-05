<?php

namespace easy\mail;

class EmailAddress
{
    public function __construct(
        public string $email,
        public ?string $name = '',
    )
    {
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if ($this->name) {
            return "$this->name <$this->email>";
        }
        return $this->email;
    }
}
