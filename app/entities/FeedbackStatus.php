<?php

namespace app\entities;

enum FeedbackStatus: string
{
    case NEW = 'new';
    case ANSWERED = 'answered';
    case PUBLISHED = 'published';
}
