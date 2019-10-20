<?php

namespace App\Http\Controllers;

use App\Database\Repositories\FacilityRepository;
use App\Http\Requests\FacilityStoreRequest;
use App\Http\Resources\FacilityResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct(FacilityRepository $facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return FacilityResource::collection($this->facilityRepository->getAllByUserId(Auth::id()));
    }

    public function store(FacilityStoreRequest $request): FacilityResource
    {
        $data = [
            'user_id'        => Auth::id(),
            'title'          => $request->get('title'),
            'price'          => $request->input('price.nominal'),
            'currency'       => $request->input('price.currency'),
            'expenses'       => $request->get('expenses'),
            'working_time'   => $request->get('workingTime'),
            'transport_time' => $request->get('transportTime'),
            'deadline_time'  => $request->get('deadlineTime'),
        ];
        $facility = $this->facilityRepository->create($data);

        return new FacilityResource($facility);
    }

    public function show(int $facilityId): FacilityResource
    {
        $facility = $this->facilityRepository->getByIdAndUserIdOrFail($facilityId, Auth::id());

        return new FacilityResource($facility);
    }

    public function update(FacilityStoreRequest $request, int $facilityId): FacilityResource
    {
        $data = [
            'title'          => $request->get('title'),
            'price'          => $request->input('price.nominal'),
            'currency'       => $request->input('price.currency'),
            'expenses'       => $request->get('expenses'),
            'working_time'   => $request->get('workingTime'),
            'transport_time' => $request->get('transportTime'),
            'deadline_time'  => $request->get('deadlineTime'),
        ];
        $this->facilityRepository->update($facilityId, $data, Auth::id());

        return new FacilityResource($this->facilityRepository->getByIdAndUserIdOrFail($facilityId, Auth::id()));
    }

    public function destroy(int $facilityId)
    {
        $this->facilityRepository->delete($facilityId, Auth::id());
    }
}
