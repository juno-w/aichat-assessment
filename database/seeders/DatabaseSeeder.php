<?php

namespace Database\Seeders;

use App\Models\PurchaseTransaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
            VoucherSeeder::class,
            PurchaseTransactionSeeder::class,
        ]);
    }
}
