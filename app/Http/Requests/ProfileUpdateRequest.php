<?php

namespace App\Http\Requests;

use App\Entities\Enum\CurrencyEnum;
use App\Entities\Enum\LanguageEnum;
use App\Entities\Enum\ProfileThemeEnum;
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
            'desiredIncome.nominal'  => 'required|numeric',
            'desiredIncome.currency' => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'language'               => 'required|string|in:' . implode(',', LanguageEnum::getValues()),
            'workHoursInMonth'       => 'required|integer|max:672',
            'theme'                  => 'required|string|in:' . implode(',', ProfileThemeEnum::getValues()),
        ];
    }
}
