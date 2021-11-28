<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 2000),
            'total_spent' => $this->faker->randomFloat(2, 10, 100),
            'total_saving' => $this->faker->randomFloat(2, 10, 100),
            'transaction_at' => $this->faker->dateTimeBetween('-1 months', 'now'),
        ];
    }
}
