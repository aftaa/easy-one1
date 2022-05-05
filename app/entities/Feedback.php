<?php

namespace app\entities;

use easy\db\ORM\Entity;

class Feedback extends Entity
{
    public ?int $id = null;
    public string $from;
    public string $email;
    public string $question;
    public ?string $answer;
    public \DateTime $question_date;
    public ?\DateTime $answer_date;
    public FeedbackStatus $status;
}
