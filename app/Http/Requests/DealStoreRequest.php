<?php

namespace App\Http\Requests;

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
            'price.nominal' => 'required|integer',
            'price.currency' => 'required|string|max:3',
            'datetime' => 'required|date_format:Y-m-d\TH:i:s',
            'address' => 'required|string|max:100',
            'deadline' => 'srequired|date_format:Y-m-d\TH:i:s',
        ];
    }
}
