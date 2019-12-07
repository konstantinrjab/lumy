<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response): JsonResponse
    {
        return JsonResponse::create(['data' => ['success' => true]]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response): JsonResponse
    {
        return  JsonResponse::create(['data' => ['success' => false, 'message' => trans($response)]], 400);
    }
}
