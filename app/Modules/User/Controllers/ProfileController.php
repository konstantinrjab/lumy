<?php

namespace App\Modules\User\Controllers;

use App\Database\Repositories\ProfileRepository;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests\ProfileUpdateRequest;
use App\Modules\User\Resources\ProfileResource;
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
