<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
  use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TblAdmin>
 */
class AdminFactory extends Factory
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
    'email' => fake()->unique()->safeEmail(),
    'phone' => fake()->phoneNumber(), // correct method
    'role_id' => fake()->numberBetween(1, 3), // adjust based on available roles
    'profile_image' => fake()->imageUrl(200, 200, 'people', true, 'Profile'), // example random image
    'password' => Hash::make('password'), // good
];

}

}
