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
            'type' => $this->faker->randomElement(['type1', 'type2', 'type3']),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(),
            'company_id' => Company::factory(),
        ];
    }
}
