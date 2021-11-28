<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VoucherIsAvailableRule implements Rule
{
    public $campaign;
    public $message = 'The vouchers are fully redeemed.';

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
        // Get the non-redeemed vouchers from DB
        $vouchers = $this->campaign->vouchers()->whereNotIn('status', ['redeemed'])->get();

        // Unlocking vouchers when customer couldn't verify the photo more than 10 minutes
        $vouchers->where('status', 'redeeming')->each(function ($voucher) {
            if ($voucher->updated_at->diffInMinutes(now()) > 10) {
                $voucher->status = 'open';
                $voucher->customer_id = null;
                $voucher->save();
            }
        });

        // Count the number of opening vouchers.
        $redeemable = $vouchers->where('status', 'open')->count();

        // Count the number of redeeming voucher
        $redeeming = $vouchers->where('status', 'redeeming')->count();

        if ($redeemable) {

            return true;
            //
        } elseif ($redeeming) {

            $this->message = 'No voucher available at the moment, please try again later.';
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
