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
            'title'           => 'required|string|max:100',
            'status'          => 'required|string|max:100|in:' . implode(',', DealStatusEnum::getValues()),
            'clientId'        => 'required|integer|max:100',
            'price.nominal'   => 'required|numeric',
            'price.currency'  => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'prepay.nominal'  => 'required|numeric',
            'prepay.currency' => 'required|string|in:' . implode(',', CurrencyEnum::getValues()),
            'facilities.*.id' => [
                'required', 'integer', 'exists:facilities,id', Rule::exists('facilities')->where(function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'start'           => 'required|date_format:' . config('app.apiDateFormat'),
            'end'             => 'required|date_format:' . config('app.apiDateFormat') . '|after:now',
            'deadline'        => 'required|date_format:' . config('app.apiDateFormat') . '|after:now',
            'address'         => 'required|string|max:100',
            'comment'         => 'string|max:100',
        ];
    }
}
