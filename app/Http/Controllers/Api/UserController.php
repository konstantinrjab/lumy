<?php

namespace App\Http\Controllers\Api;

use App\Database\Models\User\User;
use App\Database\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): UserResource
    {
        return new UserResource(User::find(Auth::id()));
    }

    public function update(UserUpdateRequest $request): UserResource
    {
        $user = Auth::user();
        $user->name = $request->get('name');
        if (!$user->save()) {
            throw new \Exception('Something went wrong');
        }

        return new UserResource(Auth::user());
    }
}
