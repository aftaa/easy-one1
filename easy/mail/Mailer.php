<?php

namespace easy\mail;

class Mailer
{
    /**
     * @return Email
     */
    public function createEmail(): Email
    {
        $email = new Email();
        $email->setFrom(new EmailAddress('no-reply@localhost'));
        return $email;
    }
}