<?php

namespace App\Modules\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name'       => 'required|string|max:100',
            'surname'    => 'nullable|string|max:100',
            'patronymic' => 'nullable|string|max:100',
            'emails'     => 'nullable|array',
            'phones'     => 'nullable|array',
            'emails.*'   => 'string|email',
            'phones.*'   => 'string',
            'comment'    => 'nullable|string|max:100',
        ];
    }
}
