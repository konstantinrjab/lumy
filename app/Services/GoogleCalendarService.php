<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Google_Client;
use Google_Service_Calendar;
use Google_Exception;
use Google_Service_Exception;
use DateInterval;

class GoogleCalendarService
{
    private const CALENDAR_ID_PRIMARY = 'primary';

    public function createEventByDeal(Deal $deal): bool
    {
        $client = $this->getClient();
        if (!$client) {
            return true;
        }
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event();
        $this->fillEventByDeal($deal, $event);

        // TODO: add ability to choice calendar
        $calendarId = self::CALENDAR_ID_PRIMARY;
        try {
            $calendarEvent = $service->events->insert($calendarId, $event);
        } catch (Google_Service_Exception $exception) {
            return false;
        }
        $deal->google_calendar_id = $calendarEvent->id;
        $deal->save();

        return true;
    }

    public function updateEventByDeal(Deal $deal): bool
    {
        $client = $this->getClient();
        if (!$client) {
            return true;
        }
        $service = new Google_Service_Calendar($client);
        try {
            // TODO: add ability to choice calendar
            $event = $service->events->get(self::CALENDAR_ID_PRIMARY, $deal->google_calendar_id);
            $this->fillEventByDeal($deal, $event);

            $service->events->update(self::CALENDAR_ID_PRIMARY, $event->getId(), $event);
        } catch (Google_Service_Exception $exception) {
            return false;
        }

        return true;
    }

    public function deleteEventByDeal(Deal $deal): bool
    {
        $client = $this->getClient();
        if (!$client) {
            return true;
        }
        $service = new Google_Service_Calendar($client);
        try {
            // TODO: add ability to choice calendar
            $service->events->delete(self::CALENDAR_ID_PRIMARY, $deal->google_calendar_id);
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

    private function fillEventByDeal(Deal $deal, Google_Service_Calendar_Event $event): void
    {
        $event->setSummary($deal->title);
        $event->setLocation($deal->address);
        $event->setDescription($deal->comment);

        $endTime = $deal->end;
        if (!$endTime) {
            $endTime = clone $deal->start;
            $endTime->add(DateInterval::createFromDateString('+1 hours'));
        }

        $start = new Google_Service_Calendar_EventDateTime([
            'dateTime' => $deal->start,
            'timeZone' => 'Etc/UTC'
        ]);
        $end = new Google_Service_Calendar_EventDateTime([
            'dateTime' => $endTime,
            'timeZone' => 'Etc/UTC'
        ]);
        $event->setStart($start);
        $event->setEnd($end);
    }
}
