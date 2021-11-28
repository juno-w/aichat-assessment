<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class HundredDollarsWithinThirtyDaysRule implements Rule
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
        // Query customer from DB
        $customer = Customer::query()
            ->where('email', $value)
            ->with([
                'purchaseTransactions' => function ($query) {
                    $query->last30days();
                }
            ])
            ->first();

        // Check if customer has at least three transaction within last 30 days
        $atLeastThreeTransactions = $customer?->purchaseTransactions->count() >= 3;

        // Check if the sum of transactions is at least $100
        $atLeast100dollars = $customer?->purchaseTransactions->sum('total_spent') >= 100;

        // Check if customer have not redeemed the voucher before.
        $notRedeemYet = $this->campaign->vouchers()->where('customer_id', $customer?->id)->count() === 0;

        // Return true if all conditions are met
        return $atLeastThreeTransactions && $atLeast100dollars && $notRedeemYet;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is ineligible or may have redeemed the voucher.';
    }
}
