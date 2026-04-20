<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<adresses>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->randomElement(['home', 'work']),
            'phone' => fake()->phoneNumber(),

            'country' => 'Egypt',
            'city' => fake()->city(),
            'state' => fake()->state(),

            'street' => fake()->streetName(),
            'building' => fake()->buildingNumber(),
            'floor' => fake()->numberBetween(1, 10),
            'apartment' => fake()->numberBetween(1, 20),

            'notes' => fake()->sentence(),
            'is_default' => false,
        ];
    }
}
