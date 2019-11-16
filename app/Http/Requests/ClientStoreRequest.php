<?php

namespace App\Http\Requests;

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
            'surname'    => 'present|string|max:100',
            'patronymic' => 'present|string|max:100',
            'emails'     => 'present|array',
            'phones'     => 'present|array',
            'emails.*'   => 'string|email',
            'phones.*'   => 'string',
            'comment'    => 'present|string|max:100',
        ];
    }
}
