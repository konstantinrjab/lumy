<?php

namespace App\Modules\Expense\Controllers;

use App\Modules\Expense\Repositories\ExpenseRepository;
use App\Http\Controllers\Controller;
use App\Modules\Expense\Requests\ExpenseStoreRequest;
use App\Modules\Expense\Resources\ExpenseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private ExpenseRepository $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return ExpenseResource::collection($this->expenseRepository->getAllByUserId(Auth::id()));
    }

    public function store(ExpenseStoreRequest $request)
    {
        $data = $this->getRequestData($request);
        $data['user_id'] = Auth::id();
        $expense = $this->expenseRepository->create($data);

        return new ExpenseResource($expense);
    }

    public function show(int $dealId): ExpenseResource
    {
        $expense = $this->expenseRepository->getByIdAndUserIdOrFail($dealId, Auth::id());

        return new ExpenseResource($expense);
    }

    public function update(ExpenseStoreRequest $request, $expenseId): ExpenseResource
    {
        $this->expenseRepository->update($expenseId, $this->getRequestData($request), Auth::id());

        return new ExpenseResource($this->expenseRepository->getByIdAndUserIdOrFail($expenseId, Auth::id()));
    }

    public function destroy(int $expenseId)
    {
        $this->expenseRepository->delete($expenseId, Auth::id());
    }

    private function getRequestData(ExpenseStoreRequest $request)
    {
        return [
            'title'      => $request->get('title'),
            'price'      => $request->input('price.nominal'),
            'currency'   => $request->input('price.currency'),
            'type'       => $request->get('type'),
            'is_active'  => $request->get('isActive'),
            'start_date' => $request->get('startDate'),
            'period'     => $request->get('period'),
        ];
    }
}
