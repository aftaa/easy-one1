<?php

namespace easy\auth;

use app\config\auth\passwordRecovery\Config;
use easy\mail\Email;
use easy\mail\EmailBody;

class RecoveryPassword
{
    public string $recoveryCode;
    public string $email;

    public function __construct(
        private Config $config,
    )
    {
    }


    /**
     * @return void
     */
    public function makeRecoveryCode(): void
    {
        $this->recoveryCode = md5($this->config->url . time() . $this->email . rand(0, 100));
    }

    /**
     * @return bool
     */
    public function sendRecoveryMail(): bool
    {
        return (new Email())
            ->addTo($this->email)
            ->setFrom('max@kuba.msk.ru', 'easy-one')
            ->setSubject('Recovery password')
            ->setBody(new EmailBody("Link to recovery password: {$this->config->url}$this->recoveryCode"))
            ->send();
    }
}
