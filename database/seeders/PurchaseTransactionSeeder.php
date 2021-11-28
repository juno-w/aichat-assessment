<?php

namespace Database\Seeders;

use App\Models\PurchaseTransaction;
use Illuminate\Database\Seeder;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseTransaction::factory()->count(5000)->create();
    }
}
