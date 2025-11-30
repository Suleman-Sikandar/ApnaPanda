<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TblAdminFactory extends Factory
{
    protected $model = \App\Models\TblAdmin::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'profile_image' => null,
            'role_id' => 3,
            'password' => Hash::make('password'),
        ];
    }
}
