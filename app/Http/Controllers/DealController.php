<?php

namespace App\Http\Controllers;

use App\Database\Repositories\DealRepository;
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
        return $this->dealRepository->getByUserId(Auth::id());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $dealId)
    {
        return $this->dealRepository->get($dealId);
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
