<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Get voucher->status = null
    public function scopeRedeemable($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeRedeeming($query)
    {
        return $query->where('status', 'redeeming');
    }

    // Set to redeeming
    public function setToRedeeming($email)
    {
        $customer = Customer::select('id')->where('email', $email)->first();

        $this->update([
            'status' => 'redeeming',
            'customer_id' => $customer->id
        ]);
    }

    // Set voucher to redeemed
    public function setToRedeemed()
    {
        $this->update([
            'status' => 'redeemed'
        ]);
    }

    // Scope to get voucher's updated date time in less than 10 minutes
    public function scopeWithin10minutes($query)
    {
        return $query->where('updated_at', '>=', now()->subMinutes(10));
    }
}
