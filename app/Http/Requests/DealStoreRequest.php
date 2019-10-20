<?php

namespace App\Http\Requests;

use App\Entities\Enum\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;

class DealStoreRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'price.nominal' => 'required|numeric',
            'price.currency' => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'datetime' => 'required|date_format:' . config('app.dateFormat') . '|after:now',
            'address' => 'required|string|max:100',
            'deadline' => 'required|date_format:' . config('app.dateFormat') . '|after:now'
        ];
    }
}
