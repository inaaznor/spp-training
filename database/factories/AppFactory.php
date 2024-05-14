<?php

namespace Database\Factories;

use App\Models\Lookup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\App>
 */
class AppFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "new_file_no" => 'SPP/S/' . rand(10000, 99999),
            "other_file_no" => 'SPP/S/' . rand(10000, 99999),
            "nokp" => $this->faker->numberBetween(100000000000, 999999999999),
            "old_kp" => 'A' . $this->faker->numberBetween(10000, 99999),
            "position_category_id" => Lookup::inRandomOrder()->first()->id,
            "file_date" => date('Y-m-d'),
            "status" => 1,
            "reg_status" => 1,
            "location" => 1,
            "active" => 1,
            "dob" => date('Y-m-d'),
        ];
    }
}