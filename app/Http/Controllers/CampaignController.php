<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RedeemVoucherRequest;
use App\Http\Requests\CustomerEligibilityCheckRequest;

class CampaignController extends Controller
{
    /**
     * Check if the campaign is valid and customer is eligible.
     *`
     * @param  \App\Models\Campaign  $campaign
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Campaign $campaign, CustomerEligibilityCheckRequest $request)
    {
        $validated = $this->validate($request, [
            'email' => 'required|email'
        ]);

        $campaign->vouchers()->redeemable()->first()->setToRedeeming($validated['email']);

        return response()->json([
            'message' => 'Congrats! You\'re eligible for this campaign. Kindly proceed to upload your photo with product to redeem the voucher in 10 minutes time. First come first serve basis.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @param  \App\Http\Requests\RedeemVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function redeemVoucher(Campaign $campaign, RedeemVoucherRequest $request)
    {
        // Get the Customer from DB
        $customer = Customer::where('email', $request->email)->first();

        // Get the Voucher from DB
        $voucher = $campaign->vouchers()->redeeming()->where('customer_id', $customer->id)->first();

        // Make sure all transactions are completed. Rollback if one of the transaction fails.
        DB::transaction(function () use ($voucher, $customer) {
            // Set the voucher to redeemed.
            $voucher->setToRedeemed();

            // Send the voce to the customer.
            // $customer->notify(new VoucherRedeemedNotification($voucher));
        });

        // Return the voucher code
        return response()->json([
            'code' => $voucher->code
        ]);
    }
}
