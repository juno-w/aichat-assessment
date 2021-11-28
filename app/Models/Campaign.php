<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    use HasUUID;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'active' => 'boolean',
    ];

    // Check if the campaign is active
    public function getIsValidAttribute()
    {
        return ($this->active && now() >= $this->start_date && $this->voucherIsRedeemable());
    }

    // Check if the voucher is redeemable
    public function voucherIsRedeemable()
    {
        return $this->voucher()->redeemable()->count() > 0;
    }

    // Check if the voucher is locked/redeeming
    public function voucherHasRedeeming()
    {
        return $this->voucher()->redeeming()->count() > 0;
    }

    // Relationship
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
