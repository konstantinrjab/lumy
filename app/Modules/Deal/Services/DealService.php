<?php

namespace App\Modules\Deal\Services;

use App\Modules\Deal\Models\Deal;
use App\Modules\Deal\Repositories\DealRepository;
use App\Modules\Deal\Requests\DealStoreRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DealService
{
    private DealRepository $dealRepository;
    private GoogleCalendarService $calendarService;

    public function __construct(DealRepository $dealRepository, GoogleCalendarService $calendarService)
    {
        $this->dealRepository = $dealRepository;
        $this->calendarService = $calendarService;
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

        $deal = $this->dealRepository->create($data);

        if ($request->input('googleCalendar.save')) {
            $this->calendarService->createEventByDeal($deal);
        }

        return $deal;
    }

    public function update(DealStoreRequest $request, int $dealId, int $userId): bool
    {
        $data = $this->getUpdatableDataFromRequest($request);

        $deal = $this->dealRepository->getByIdAndUserIdOrFail($dealId, $userId);

        if (!$this->dealRepository->update($deal, $data)) {
            return false;
        }
        if ($deal->google_calendar_id) {
            $this->calendarService->updateEventByDeal($deal);
        } elseif (!$deal->google_calendar_id && $request->input('googleCalendar.save')) {
            $this->calendarService->createEventByDeal($deal);
        }

        return true;
    }

    public function delete(int $dealId, int $userId): bool
    {
        $deal = $this->dealRepository->getByIdAndUserId($dealId, $userId);
        if (!$deal) {
            return true;
        }

        if ($deal->google_calendar_id) {
            $this->calendarService->deleteEventByDeal($deal);
        }
        $deal->delete();

        return true;
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
            'comment'         => $request->get('comment'),
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
