<?php

namespace easy\mail;

class Email
{
    private EmailAddress $from;
    /** @var EmailAddress[] */
    private array $to;
    private string $subject;
    private EmailBody $body;

    /**
     * @param EmailAddress|string $email
     * @param string|null $name
     * @return $this
     */
    public function setFrom(mixed $email, ?string $name = ''): static
    {
        if ($email instanceof EmailAddress) {
            $this->from = $email;
        } else {
            $this->from = new EmailAddress($email, $name);
        }
        return $this;
    }

    /**
     * @param EmailAddress|string $email
     * @param string|null $name
     * @return $this
     */
    public function addTo(mixed $email, ?string $name = ''): static
    {
        if ($email instanceof EmailAddress) {
            $this->to[$email->email] = $email;
        } else {
            $this->to[$email] = new EmailAddress($email, $name);
        }
        return $this;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): static
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param EmailBody $body
     * @return $this
     */
    public function setBody(EmailBody $body): static
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        $headers = ['From' => $this->from->render()];
        $to = [];
        foreach ($this->to as $item) {
            $to[] = $item->render();
        }
        $to = join(', ', $to);
        return mail($to, $this->subject, $this->body->text, $headers);
    }
}
