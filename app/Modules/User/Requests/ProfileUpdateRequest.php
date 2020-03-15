<?php

namespace App\Modules\User\Requests;

use App\Enum\CurrencyEnum;
use App\Modules\User\Enum\LanguageEnum;
use App\Modules\User\Enum\ProfileThemeEnum;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'desiredIncome.nominal'  => 'required|numeric|between:0,999999999.99',
            'desiredIncome.currency' => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'language'               => 'required|string|in:' . implode(',', LanguageEnum::getValues()),
            'workHoursInMonth'       => 'required|integer|max:672',
            'theme'                  => 'required|string|in:' . implode(',', ProfileThemeEnum::getValues()),
        ];
    }
}
