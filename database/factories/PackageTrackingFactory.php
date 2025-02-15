<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Destination;
use App\Models\Package;
use App\Models\PackageTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageTrackingFactory extends Factory
{
    protected $model = PackageTracking::class;

    public function definition()
    {
        return [
            'package_id' => Package::factory(),
            'container_id' => Container::factory(),
            'destination_id' => Destination::factory(),
            'tracking_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => $this->faker->boolean(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}