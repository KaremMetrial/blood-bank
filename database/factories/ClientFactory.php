<?php

namespace Database\Factories;

use App\Models\BloodType;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('123456789'),
            'd_o_b' => fake()->date(),
            'blood_type_id' => BloodType::inRandomOrder()->first()->id ?? 1,
            'city_id' => City::inRandomOrder()->first()->id ?? 1,
            'last_donation_date' => fake()->date(),
            'pin_code' => fake()->randomNumber(5, true)];
    }
}
