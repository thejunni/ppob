<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->company,
            'saldo' => $this->faker->numberBetween(1000000, 10000000)
        ];
    }
}

