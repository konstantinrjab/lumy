<?php

namespace App\Http\Controllers\Api\Auth;

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

    private $registerController;

    public function __construct(GoogleRegisterController $registerController)
    {
        $this->middleware('guest')->except('logout');
        $this->registerController = $registerController;
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->registerController->register($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return ['token' => $this->guard()->user()->api_token];
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'id_token' => ['required', 'string'],
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where(['google_id' => $request->get('id_token')])->first();

        if (!$user) {
            $this->registerController->register($request);
        }

        return Auth::loginUsingId(Auth::id());
    }
}
