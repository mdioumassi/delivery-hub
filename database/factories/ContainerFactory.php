<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    protected $model = Container::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['baril', 'valise', 'vehicule']),
            'unit_price' => $this->faker->randomFloat(2, 100, 1000),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(),
            'client_id' => User::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
