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

        $client->setAccessToken(Auth::user()->social->google_token);

        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new \Exception(join(', ', $accessToken));
                }
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        return $client;
    }
}
