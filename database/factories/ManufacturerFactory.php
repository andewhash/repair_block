<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{


    protected $model = Manufacturer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'country' => $this->faker->country,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function eedefinition(): array
    {
        return [
            //
        ];
    }
}
