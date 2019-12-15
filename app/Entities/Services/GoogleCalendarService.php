<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    /**
     * @param Deal $deal
     * @return Google_Service_Calendar_Event
     * @throws \Google_Exception
     */
    public function createEventByDeal(Deal $deal)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event([
            'summary' => $deal->title,
            // TODO: add this field as optional on frontend
            'location' => '',
            'description' => $deal->comment,
            'start' => [
                'dateTime' => $deal->start,
                // TODO: set it dynamically
                'timeZone' => 'Europe/Kiev',
            ],
            'end' => [
                'dateTime' => $deal->end,
                // TODO: set it dynamically
                'timeZone' => 'Europe/Kiev',
            ],
        ]);

        // TODO: add ability to choice calendar
        $calendarId = 'primary';

        return $service->events->insert($calendarId, $event);
    }

    /**
     * @return Google_Client
     * @throws \Google_Exception
     */
    private function getClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName(config('app.name'));
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/google-calendar/client_secret_web.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $client->setAccessToken([
            'access_token' => Auth::user()->google_token
        ]);

        return $client;
    }
}
