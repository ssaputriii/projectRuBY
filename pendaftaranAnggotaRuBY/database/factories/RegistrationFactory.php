<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('08##########'),
            'business_type' => $this->faker->randomElement(['Kuliner','Fashion','Kerajinan','Jasa']),
            'umkm_category' => $this->faker->randomElement(['UMUM','UTAMA','PRIORITAS']),
            'status' => $this->faker->randomElement(['pending','accepted','rejected']),
        ];
    }
}

