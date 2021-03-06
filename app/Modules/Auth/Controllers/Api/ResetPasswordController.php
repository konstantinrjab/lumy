<?php

namespace App\Modules\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     */
    protected string $redirectTo = '/home';

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    protected function sendResetResponse(Request $request, $response): JsonResponse
    {
        return JsonResponse::create(['data' => ['success' => true]]);
    }

    protected function sendResetFailedResponse(Request $request, $response): JsonResponse
    {
        return  JsonResponse::create(['data' => ['success' => false, 'message' => trans($response)]], 400);
    }
}
