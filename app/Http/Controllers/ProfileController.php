<?php

namespace App\Http\Controllers;

use App\Database\Models\Profile;
use App\Database\Repositories\ProfileRepository;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index(): ProfileResource
    {
        return new ProfileResource($this->profileRepository->getByUserId(Auth::id()));
    }

    public function update(ProfileStoreRequest $request): ProfileResource
    {
        $data = [
            'workHours_in_month' => $request->get('workHoursInMonth'),
            'salary' => $request->input('price.nominal'),
            'currency' => $request->input('price.currency')
        ];
        $this->profileRepository->update(Auth::id(), $data);

        return new ProfileResource($this->profileRepository->get(Auth::id()));
    }
}
