<?php

namespace App\Http\Controllers;

use App\Database\Models\Profile;
use App\Database\Repositories\ProfileRepository;
use App\Http\Requests\FacilityStoreRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index(): Profile
    {
        return $this->profileRepository->getByUserId(Auth::id());
    }

    public function update(FacilityStoreRequest $request)
    {
        $this->profileRepository->update(Auth::id(), $request->toArray());
    }
}
