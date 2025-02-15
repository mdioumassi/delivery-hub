<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition()
    {
        return [
            'country' => $this->faker->country(),
            'package_id' => Package::factory(),
            'container_id' => Container::factory(),
        ];
    }
}
