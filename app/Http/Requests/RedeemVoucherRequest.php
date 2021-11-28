<?php

namespace App\Http\Requests;

use App\Rules\HasRedeemingRule;
use App\Rules\PhotoHasProductRule;
use Illuminate\Foundation\Http\FormRequest;

class RedeemVoucherRequest extends FormRequest
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
                'bail',
                'required',
                'exists:customers,email',
                new HasRedeemingRule($this->campaign)
            ],
            'file' => [
                'bail',
                'required',
                'file',
                'mimes:jpg,bmp,png',
                'max:10240',
                new PhotoHasProductRule
            ],
        ];
    }
}
