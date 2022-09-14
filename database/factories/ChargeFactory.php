<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charge>
 */
class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'value'  => $this->faker->numberBetween(1,10),
            'min'    => $this->faker->numberBetween(1,1000),
            'max'    => $this->faker->numberBetween(1000,100000000),
            'status' => $this->faker->boolean(),
        ];
    }
}
