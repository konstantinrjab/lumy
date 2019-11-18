<?php

namespace App\Entities\Services;

use App\Database\Models\Deal;
use App\Database\Repositories\DealRepository;
use App\Http\Requests\DealStoreRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DealService
{
    private $dealRepository;

    public function __construct(DealRepository $dealRepository)
    {
        $this->dealRepository = $dealRepository;
    }

    public function store(DealStoreRequest $request): ?Deal
    {
        $data = array_merge(
            [
                'user_id'   => Auth::id(),
                'client_id' => $request->get('clientId'),
            ],
            $this->getUpdatableDataFromRequest($request)
        );

        return $this->dealRepository->create($data);
    }

    public function update(DealStoreRequest $request, int $dealId, int $userId): bool
    {
        $data = $this->getUpdatableDataFromRequest($request);

        return $this->dealRepository->update($dealId, $data, $userId);
    }

    private function getUpdatableDataFromRequest(DealStoreRequest $request): array
    {
        return [
            'status'          => $request->get('status'),
            'title'           => $request->get('title'),
            'price'           => $request->input('price.nominal'),
            'currency'        => $request->input('price.currency'),
            'prepay_price'    => $request->input('prepay.nominal'),
            'prepay_currency' => $request->input('prepay.currency'),
            'address'         => $request->get('address'),
            'deadline'        => $request->get('deadline')
                ? Carbon::parse($request->get('deadline'))->format(config('app.mysqlDateFormat'))
                : null,
            'start'           => $request->get('start')
                ? Carbon::parse($request->get('start'))->format(config('app.mysqlDateFormat'))
                : null,
            'end'             => $request->get('end')
                ? Carbon::parse($request->get('end'))->format(config('app.mysqlDateFormat'))
                : null,
            'facilities'      => $request->input('facilities'),
        ];
    }
}
