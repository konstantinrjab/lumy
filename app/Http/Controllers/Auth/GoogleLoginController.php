<?php

namespace App\Http\Controllers\Auth;

use App\Database\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return ['token' => $this->guard()->user()->api_token];
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where(['google_id' => $request->get('id_token')])->first();

        if (!$user) {
            $this->sendFailedLoginResponse($request);
        }

        return Auth::loginUsingId($user->id);
    }
}
