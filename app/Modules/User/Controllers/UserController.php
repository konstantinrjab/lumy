<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Models\User;
use App\Modules\User\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests\UserUpdateRequest;
use App\Modules\User\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Exception;

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
            throw new Exception('User update fails');
        }

        return new UserResource(Auth::user());
    }
}
