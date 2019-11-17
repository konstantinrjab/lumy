<?php

namespace App\Http\Requests;

use App\Entities\Enum\CurrencyEnum;
use App\Entities\Enum\DealStatusEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'title'               => 'required|string|max:100',
            'status'              => 'nullable|string|max:100|in:' . implode(',', DealStatusEnum::getValues()),
            'clientId'            => 'nullable|integer', 'exists:clients,id',
            'price.nominal'       => 'nullable|numeric|required_with:price.currency',
            'price.currency'      => 'nullable|string|required_with:price.nominal|in:' . implode(',', CurrencyEnum::getValues()),
            'prepay.nominal'      => 'nullable|numeric',
            'prepay.currency'     => 'nullable|string|in:' . implode(',', CurrencyEnum::getValues()),
            'facilities.*.number' => 'required|integer',
            'facilities.*.id'     => [
                'required', 'integer', 'exists:facilities,id', Rule::exists('facilities')->where(function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'start'               => 'nullable|date_format:' . config('app.apiDateFormat'),
            'end'                 => 'nullable|date_format:' . config('app.apiDateFormat') . '|after:now',
            'deadline'            => 'nullable|date_format:' . config('app.apiDateFormat') . '|after:now',
            'address'             => 'nullable|string|max:100',
            'comment'             => 'nullable|string|max:100',
        ];
    }
}
