<?php

namespace App\Http\Controllers\Api;

use App\Database\Repositories\ProfileRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index(): ProfileResource
    {
        return new ProfileResource($this->profileRepository->getByUserId(Auth::id()));
    }

    public function update(ProfileUpdateRequest $request): ProfileResource
    {
        $data = [
            'work_hours_in_month' => $request->get('workHoursInMonth'),
            'desired_income_nominal' => $request->input('desiredIncome.nominal'),
            'desired_income_currency' => $request->input('desiredIncome.currency'),
            'language' => $request->input('language'),
            'theme' => $request->input('theme'),
        ];
        $this->profileRepository->updateByUserId(Auth::id(), $data);

        return new ProfileResource($this->profileRepository->getByUserId(Auth::id()));
    }
}
