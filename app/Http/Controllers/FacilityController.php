<?php

namespace App\Http\Controllers;

use App\Database\Repositories\FacilityRepository;
use App\Http\Requests\FacilityStoreRequest;
use App\Http\Resources\FacilityResource;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct(FacilityRepository $facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }

    public function index()
    {
        return $this->facilityRepository->getByUserId(Auth::id());
    }

    public function store(FacilityStoreRequest $request): FacilityResource
    {
        $data = [
            'user_id'       => Auth::id(),
            'title'         => $request->get('title'),
            'price'         => $request->input('price.nominal'),
            'currency'      => $request->input('price.currency'),
            'expenses'      => $request->get('expenses'),
            'workingTime'   => $request->get('workingTime'),
            'transportTime' => $request->get('transportTime'),
            'deadlineTime'  => $request->get('deadlineTime'),
        ];
        $facility = $this->facilityRepository->create($data);

        return new FacilityResource($facility);
    }

    public function show(int $facilityId): FacilityResource
    {
        return new FacilityResource($this->facilityRepository->get($facilityId));
    }

    public function update(FacilityStoreRequest $request, int $facilityId): FacilityResource
    {
        $this->facilityRepository->update($facilityId, $request->toArray());

        return new FacilityResource($this->facilityRepository->get($facilityId));
    }

    public function destroy(int $facilityId)
    {
        $this->facilityRepository->delete($facilityId);
    }
}
