<?php

namespace App\Modules\Deal\Controllers;

use App\Modules\Deal\Repositories\DealRepository;
use App\Modules\Deal\Services\DealService;
use App\Http\Controllers\Controller;
use App\Modules\Deal\Requests\DealStoreRequest;
use App\Modules\Deal\Resources\DealResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    private DealRepository $dealRepository;
    private DealService $dealService;

    public function __construct(DealRepository $dealRepository, DealService $dealService)
    {
        $this->dealRepository = $dealRepository;
        $this->dealService = $dealService;
    }

    public function index(): AnonymousResourceCollection
    {
        return DealResource::collection($this->dealRepository->getAllByUserId(Auth::id()));
    }

    public function store(DealStoreRequest $request)
    {
        $deal = $this->dealService->store($request);

        return new DealResource($deal);
    }

    public function show(int $dealId): DealResource
    {
        $deal = $this->dealRepository->getByIdAndUserIdOrFail($dealId, Auth::id());

        return new DealResource($deal);
    }

    public function update(DealStoreRequest $request, $dealId): DealResource
    {
        $this->dealService->update($request, $dealId, Auth::id());

        return new DealResource($this->dealRepository->getByIdAndUserIdOrFail($dealId, Auth::id()));
    }

    public function destroy(int $dealId)
    {
        $this->dealService->delete($dealId, Auth::id());
    }
}
