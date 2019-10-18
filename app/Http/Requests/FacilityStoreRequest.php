<?php

namespace App\Http\Requests;

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
            'title' => 'required|string|max:100',
            'price.nominal' => 'required|integer',
            'price.currency' => 'required|string|max:3',
            'expenses' => 'array',
            'workingTime' => 'required|integer',
            'transportTime' => 'required|integer',
            'deadlineTime' => 'required|integer',
        ];
    }
}
