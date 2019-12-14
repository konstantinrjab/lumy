<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    public function createEventByDeal(Deal $deal)
    {
        $client = new Google_Client();
        $client->setApplicationName(config('app.name'));
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/google-calendar/client_secret_web.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $client->setAccessToken([
            'access_token'=> Auth::user()->google_token
        ]);
        $this->addEvent($deal, $client);
    }

    // TODO: refactor this
    private function addEvent(Deal $deal, $client)
    {
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event([
            'summary' => $deal->title,
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => $deal->comment,
            'start' => [
                'dateTime' => $deal->start,
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => $deal->end,
                'timeZone' => 'America/Los_Angeles',
            ],
//            'recurrence' => [
//                'RRULE:FREQ=DAILY;COUNT=2'
//            ],
//            'attendees' => [
//                ['email' => 'lpage@example.com'],
//                ['email' => 'sbrin@example.com'],
//            ],
//            'reminders' => [
//                'useDefault' => false,
//                'overrides' => [
//                    ['method' => 'email', 'minutes' => 24 * 60],
//                    ['method' => 'popup', 'minutes' => 10],
//                ],
//            ],
        ]);

        $calendarId = 'primary';

        return $service->events->insert($calendarId, $event);
    }
}
