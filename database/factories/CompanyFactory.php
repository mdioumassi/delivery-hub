<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'logo_url' => $this->faker->imageUrl(),
            'phone_fixe' => $this->faker->phoneNumber(),
            'phone_mobile' => $this->faker->phoneNumber(),
            'phone_whatsapp' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'gestionnaire_id' => User::factory(),
        ];
    }
}
