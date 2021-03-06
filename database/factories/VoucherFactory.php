<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'campaign_id' => 1,
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
        ];
    }
}
