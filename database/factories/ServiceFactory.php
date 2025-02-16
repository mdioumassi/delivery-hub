<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Envoi aérien', ' Envoi maritime', 'Envoi routier']),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(),
            'company_id' => Company::factory(),
        ];
    }
}
