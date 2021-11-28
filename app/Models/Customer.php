<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * Relationships
     */
    public function purchaseTransactions()
    {
        return $this->hasMany(PurchaseTransaction::class);
    }
}
