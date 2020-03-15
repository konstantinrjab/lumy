<?php

namespace App\Http\Requests;

use App\Enum\CurrencyEnum;
use App\Modules\Expense\Enum\ExpenseTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'          => 'required|string|max:100',
            'price.nominal'  => 'required|numeric|between:0,999999999.99',
            'price.currency' => 'required|string|max:3|in:' . implode(',', CurrencyEnum::getValues()),
            'type'           => 'required|in:' . implode(',', ExpenseTypeEnum::getValues()),
            'isActive'       => 'required|boolean',
            'startDate'      => 'nullable|date_format:' . config('app.apiDateFormat'),
            'period'         => 'nullable|integer',
        ];
    }
}
