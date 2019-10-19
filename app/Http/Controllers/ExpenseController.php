<?php

namespace App\Http\Controllers;

use App\Database\Repositories\ExpenseRepository;
use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return ExpenseResource::collection($this->expenseRepository->getByUserId(Auth::id()));
    }

    public function store(ExpenseStoreRequest $request)
    {
        $data = [
            'user_id'  => Auth::id(),
            'title'    => $request->get('title'),
            'price'    => $request->input('price.nominal'),
            'currency' => $request->input('price.currency'),
            'type'     => $request->get('type'),
        ];
        $expense = $this->expenseRepository->create($data);

        return new ExpenseResource($expense);
    }

    public function show(int $dealId): ?ExpenseResource
    {
        $expense = $this->expenseRepository->get($dealId);
        if (!$expense) {
            return null;
        }

        return new ExpenseResource($expense);
    }

    public function update(ExpenseStoreRequest $request, $expenseId): ExpenseResource
    {
        $data = [
            'title'    => $request->get('title'),
            'price'    => $request->input('price.nominal'),
            'currency' => $request->input('price.currency'),
            'type'     => $request->get('type'),
        ];

        $this->expenseRepository->update($expenseId, $data);

        return new ExpenseResource($this->expenseRepository->get($expenseId));
    }

    public function destroy(int $expenseId)
    {
        $this->expenseRepository->delete($expenseId);
    }
}
