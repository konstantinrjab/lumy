<?php

namespace App\Http\Controllers;

use App\Database\Repositories\DealRepository;
use App\Http\Resources\DealResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    private $dealRepository;

    public function __construct(DealRepository $dealRepository)
    {
        $this->dealRepository = $dealRepository;
    }

    public function index()
    {
        return DealResource::collection($this->dealRepository->getByUserId(Auth::id()));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $dealId): ?DealResource
    {
        $deal = $this->dealRepository->get($dealId);
        if (!$deal) {
            return null;
        }

        return new DealResource($deal);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $dealId)
    {
        $this->dealRepository->delete($dealId);
    }
}
