<?php

namespace App\Modules\Auth\Controllers\Web;

use App\Modules\Auth\Services\GoogleAuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Google_Service_Calendar;
use Exception;

class SocialAuthGoogleController extends Controller
{
    private GoogleAuthService $googleAuthService;

    public function __construct(GoogleAuthService $googleAuthService)
    {
        $this->middleware('guest')->except('logout');
        $this->googleAuthService = $googleAuthService;
    }

    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('google')
            ->scopes(Google_Service_Calendar::CALENDAR_EVENTS)
            ->with(['access_type' => 'offline', 'prompt' => 'consent select_account'])
            ->redirect();
    }

    public function handleProviderCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            return redirect()->away(env('AUTH_REDIRECT_URL'));
        }
        $apiToken = $this->googleAuthService->handleLogin($user);

        return redirect()->away(env('AUTH_REDIRECT_URL') . '?token=' . $apiToken);
    }
}
