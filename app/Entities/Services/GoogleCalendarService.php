<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarService
{
    public function createEventByDeal(Deal $deal)
    {
        $event = new Event();

        $event->name = $deal->title;
        $event->startDateTime = $deal->start;
        $event->endDateTime = $deal->end;
        $event->addAttendee(['email' => 'krforgames@gmail.com']);
        $event->sendNotifications = true;

        $event->save();
    }
}
