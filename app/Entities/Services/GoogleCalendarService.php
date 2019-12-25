<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Google_Client;
use Google_Service_Calendar;
use Google_Exception;
use Google_Service_Exception;

class GoogleCalendarService
{
    public function createEventByDeal(Deal $deal): bool
    {
        $client = $this->getClient();
        if (!$client) {
            return null;
        }
        $endTime = $deal->end;
        if (!$endTime) {
            $endTime = clone $deal->start;
            $endTime->add(\DateInterval::createFromDateString('+1 hours'));
        }
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event([
            'summary' => $deal->title,
            'location' => $deal->address,
            'description' => $deal->comment,
            'start' => [
                'dateTime' => $deal->start,
                'timeZone' => 'Etc/UTC',
            ],
            'end' => [
                'dateTime' => $endTime,
                'timeZone' => 'Etc/UTC',
            ],
        ]);

        // TODO: add ability to choice calendar
        $calendarId = 'primary';
        try {
            $service->events->insert($calendarId, $event);
        } catch (Google_Service_Exception $exception) {
            return false;
        }

        return true;
    }

    private function getClient(): ?Google_Client
    {
        if (!Auth::user()->social->google_credentials) {
            return null;
        }
        try {
            $client = new Google_Client();
            $client->setApplicationName(config('app.name'));
            $client->setScopes(Google_Service_Calendar::CALENDAR);
            $client->setAuthConfig(storage_path('app/google-calendar/client_secret_web.json'));
            $client->setAccessType('offline');
            $client->setPrompt('select_account consent');

            $client->setAccessToken(Auth::user()->social->google_credentials);

            if ($client->isAccessTokenExpired()) {
                // Refresh the token if possible, else fetch a new one.
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                } else {
                    // TODO: logout
                }
                Auth::user()->social()->update([
                    'google_credentials' => $client->getAccessToken()
                ]);
            }
        } catch (Google_Exception $exception) {
            return null;
        }

        return $client;
    }
}
