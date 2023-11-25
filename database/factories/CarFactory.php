<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Mobil',
            'description' => fake()->address(),
            'brand_id' => rand(1, 2),
            'type_id' => rand(1, 2),
            'number_plate' => rand(1000000, 9999999),
            'price' => rand(1000000, 9999999),
        ];
    }
}
