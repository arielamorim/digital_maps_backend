<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name(),
            'X'     => $this->faker->numberBetween(1, 100),
            'Y'     => $this->faker->numberBetween(1, 100),
            'opensAt' => $this->faker->optional()->time('H:i'),
            'closesAt' => $this->faker->optional()->time('H:i'),
            'publicLocation' => $this->faker->numberBetween(0,1)
        ];
    }
}
