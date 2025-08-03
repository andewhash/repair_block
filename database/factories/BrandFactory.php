<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{

	 protected $model = Brand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'description' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function asdasddefinition(): array
    {
        return [
            //
        ];
    }
}
