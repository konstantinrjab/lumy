<?php

namespace App\Http\Controllers;

use App\Database\Repositories\DealRepository;
use App\Http\Requests\DealStoreRequest;
use App\Http\Resources\DealResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    private $dealRepository;

    public function __construct(DealRepository $dealRepository)
    {
        $this->dealRepository = $dealRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return DealResource::collection($this->dealRepository->getAllByUserId(Auth::id()));
    }

    public function store(DealStoreRequest $request)
    {
        $data = [
            'user_id'  => Auth::id(),
            'title'    => $request->get('title'),
            'price'    => $request->input('price.nominal'),
            'currency' => $request->input('price.currency'),
            'address'  => $request->get('address'),
            'dateTime' => $request->get('datetime'),
            'deadline' => $request->get('deadline'),
        ];
        $deal = $this->dealRepository->create($data);

        return new DealResource($deal);
    }

    public function show(int $dealId): DealResource
    {
        $deal = $this->dealRepository->getByIdAndUserId($dealId, Auth::id());
        if (!$deal) {
            throw new ModelNotFoundException();
        }

        return new DealResource($deal);
    }

    public function update(DealStoreRequest $request, $dealId): DealResource
    {
        $data = [
            'title'    => $request->get('title'),
            'price'    => $request->input('price.nominal'),
            'currency' => $request->input('price.currency'),
            'address'  => $request->get('address'),
            'dateTime' => $request->get('datetime'),
            'deadline' => $request->get('deadline'),
        ];

        $this->dealRepository->update($dealId, $data, Auth::id());

        return new DealResource($this->dealRepository->getByIdAndUserId($dealId, Auth::id()));
    }

    public function destroy(int $dealId)
    {
        $this->dealRepository->delete($dealId, Auth::id());
    }
}
