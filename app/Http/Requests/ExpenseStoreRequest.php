<?php

namespace App\Http\Requests;

use App\Entities\Enum\CurrencyEnum;
use App\Entities\Enum\ExpenseTypeEnum;
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
            'title'                   => 'required|string|max:100',
            'price.nominal'           => 'required|numeric',
            'price.currency'          => 'required|string|max:3|in:' . implode(',', CurrencyEnum::getValues()),
            'startDate'               => 'required|date_format:' . config('app.apiDateFormat'),
            'period'                  => 'required|integer',
            'isActive'                => 'required|boolean',
            'type'                    => 'required|in:' . implode(',', ExpenseTypeEnum::getValues()),
        ];
    }
}
