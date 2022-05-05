<?php

namespace app\mail;

use app\entities\Feedback;
use easy\mail\EmailBody;
use easy\mail\Mailer;

class FeedbackMail extends Mailer
{
    /**
     * @return void
     */
    public function sendEmail(Feedback $feedback)
    {
        $this->createEmail()
            ->addTo('after@ya.ru')
            ->setSubject("Feedback from $feedback->from <$feedback->email>")
            ->setBody(new EmailBody($feedback->question))
            ->send();
    }
}