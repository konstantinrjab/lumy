<?php

namespace App\Http\Controllers;

use App\Database\Repositories\DealRepository;
use App\Http\Requests\DealStoreRequest;
use App\Http\Resources\DealResource;
use Carbon\Carbon;
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
            'user_id'         => Auth::id(),
            'client_id'       => $request->get('clientId'),
            'title'           => $request->get('title'),
            'price'           => $request->input('price.nominal'),
            'currency'        => $request->input('price.currency'),
            'facilities'        => $request->input('facilities'),
            'prepay_price'    => $request->input('prepay.nominal'),
            'prepay_currency' => $request->input('prepay.currency'),
            'address'         => $request->get('address'),
            'deadline'        => Carbon::parse($request->get('deadline'))->format(config('app.mysqlDateFormat')),
            'start'           => Carbon::parse($request->get('start'))->format(config('app.mysqlDateFormat')),
            'end'             => Carbon::parse($request->get('end'))->format(config('app.mysqlDateFormat')),
        ];
        $deal = $this->dealRepository->create($data);

        return new DealResource($deal);
    }

    public function show(int $dealId): DealResource
    {
        $deal = $this->dealRepository->getByIdAndUserIdOrFail($dealId, Auth::id());

        return new DealResource($deal);
    }

    public function update(DealStoreRequest $request, $dealId): DealResource
    {
        $data = [
            'title'           => $request->get('title'),
            'price'           => $request->input('price.nominal'),
            'currency'        => $request->input('price.currency'),
            'prepay_price'    => $request->input('prepay.nominal'),
            'prepay_currency' => $request->input('prepay.currency'),
            'address'         => $request->get('address'),
            'deadline'        => Carbon::parse($request->get('deadline'))->format(config('app.mysqlDateFormat')),
            'start'           => Carbon::parse($request->get('start'))->format(config('app.mysqlDateFormat')),
            'end'             => Carbon::parse($request->get('end'))->format(config('app.mysqlDateFormat')),
            'facilities'      => $request->input('facilities'),
        ];

        $this->dealRepository->update($dealId, $data, Auth::id());

        return new DealResource($this->dealRepository->getByIdAndUserIdOrFail($dealId, Auth::id()));
    }

    public function destroy(int $dealId)
    {
        $this->dealRepository->delete($dealId, Auth::id());
    }
}
