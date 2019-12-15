<?php

namespace App\Http\Controllers\Web\Auth;

use App\Database\Models\User\User;
use App\Database\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthGoogleController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')
            ->scopes(\Google_Service_Calendar::CALENDAR)
            ->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleProviderCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->away(env('AUTH_REDIRECT_URL'));
        }

        $databaseUser = User::where('email', $user->email)->first();
        if (!$databaseUser) {
            $userData = [
                'name'      => $user->name,
                'email'     => $user->email,
            ];
            $databaseUser = $this->userRepository->createFromGoogle($userData, $user->id, $user->token);
        }

        return redirect()->away(env('AUTH_REDIRECT_URL') . '?token=' . $databaseUser->api_token);
    }
}
