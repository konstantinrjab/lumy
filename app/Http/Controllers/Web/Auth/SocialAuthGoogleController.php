<?php

namespace App\Http\Controllers\Web\Auth;

use App\Database\Models\User;
use App\Database\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthGoogleController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
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
                'google_id' => $user->id,
            ];
            $databaseUser = $this->userRepository->create($userData);
        }

        return redirect()->away(env('AUTH_REDIRECT_URL') . '?token=' . $databaseUser->api_token);
    }
}
