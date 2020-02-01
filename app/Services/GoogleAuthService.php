<?php

namespace App\Entities\Services;

use App\Database\Models\User\User;
use App\Database\Repositories\UserRepository;
use Laravel\Socialite\Two\User as OAuthTwoUser;

class GoogleAuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handleLogin(OAuthTwoUser $user): string
    {
        $credentials = json_encode([
            'access_token' => $user->token,
            'expires_in' => $user->expiresIn,
            'refresh_token' => $user->refreshToken,
            'created' => time(),
        ]);
        $databaseUser = User::where('email', $user->email)->first();
        if (!$databaseUser) {
            $userData = [
                'name'      => $user->name,
                'email'     => $user->email,
            ];
            $databaseUser = $this->userRepository->createFromGoogle($userData, $user->id, $credentials);
        } else {
            $databaseUser->social()->update([
                'google_credentials' => $credentials
            ]);
        }

        return $databaseUser->api_token;
    }
}
