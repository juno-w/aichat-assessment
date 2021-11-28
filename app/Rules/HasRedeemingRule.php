<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class HasRedeemingRule implements Rule
{
    public $campaign;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $customer = Customer::where('email', $value)->first();
        $redeemingVoucher = $this->campaign->vouchers()
            ->where('customer_id', $customer?->id)
            ->redeeming()
            ->within10minutes()
            ->first();

        return $redeemingVoucher ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry, the :attribute is not found.';
    }
}
