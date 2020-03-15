<?php

namespace App\Modules\Facility\Requests;

use App\Common\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;

class FacilityStoreRequest extends FormRequest
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
            'title'                     => 'required|string|max:100',
            'price.nominal'             => 'required|numeric|between:0,999999999.99',
            'price.currency'            => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'isActive'                  => 'required|boolean',
            'expenses'                  => 'nullable|present|array',
            'expenses.*.title'          => 'required|string',
            'expenses.*.price.currency' => 'required|string',
            'expenses.*.price.nominal'  => 'required|numeric|between:0,999999999.99',
            'expenses.*.number'         => 'required|integer',
            'workingTime'               => 'nullable|integer',
            'transportTime'             => 'nullable|integer',
            'deadlineTime'              => 'nullable|integer',
        ];
    }
}
