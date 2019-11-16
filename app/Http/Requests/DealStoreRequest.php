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
            'status'          => 'present|string|max:100|in:' . implode(',', DealStatusEnum::getValues()),
            'clientId'        => 'present|integer|max:100',
            'price.nominal'   => 'present|numeric',
            'price.currency'  => 'present|string|in:' . implode(',', CurrencyEnum::getValues()),
            'prepay.nominal'  => 'present|numeric',
            'prepay.currency' => 'present|string|in:' . implode(',', CurrencyEnum::getValues()),
            'facilities.*.id' => [
                'required', 'integer', 'exists:facilities,id', Rule::exists('facilities')->where(function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'start'           => 'present|date_format:' . config('app.apiDateFormat'),
            'end'             => 'present|date_format:' . config('app.apiDateFormat') . '|after:now',
            'deadline'        => 'present|date_format:' . config('app.apiDateFormat') . '|after:now',
            'address'         => 'present|string|max:100',
            'comment'         => 'present|string|max:100',
        ];
    }
}
