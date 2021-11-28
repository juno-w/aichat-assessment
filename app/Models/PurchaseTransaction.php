<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'transaction_at' => 'datetime'
    ];

    public function scopeLast30days($query)
    {
        $query->where('transaction_at', '>=', now()->subDays(30));
    }
}
