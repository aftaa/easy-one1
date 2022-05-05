<?php

namespace app\entities;

enum GuestbookEntryStatus: string
{
    case VERIFIED = 'verified';
    case PUBLISHED = 'published';
}
