<?php

namespace App\Http\Requests;

use App\Entities\Enum\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'price.nominal'    => 'required|numeric',
            'price.currency'   => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'workHoursInMonth' => 'required|integer',
        ];
    }
}