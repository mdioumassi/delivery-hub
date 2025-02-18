<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['medicament', 'bagage', 'document', 'autre']),
            'weight' => $this->faker->numberBetween(1, 1000) . 'kg',
            'unit_price' => $this->faker->randomFloat(2, 10, 500),
            'status' => $this->faker->boolean(),
            'sender_id' => User::factory(),
            'recipient_id' => User::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
