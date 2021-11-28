<?php

namespace App\Http\Requests;

use App\Rules\HundredDollarsWithinThirtyDaysRule;
use App\Rules\VoucherIsAvailableRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerEligibilityCheckRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                // 'bail',
                'required',
                new VoucherIsAvailableRule($this->campaign),
                'exists:customers,email',
                new HundredDollarsWithinThirtyDaysRule($this->campaign),
            ]
        ];
    }
}
