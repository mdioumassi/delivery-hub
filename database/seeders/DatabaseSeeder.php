<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer 10 utilisateurs
        \App\Models\User::factory(10)->create()->each(function ($user) {
            // Pour chaque utilisateur, créer 1-3 entreprises
            \App\Models\Company::factory(rand(1, 3))->create([
                'gestionnaire_id' => $user->id,
            ])->each(function ($company) {
                // Pour chaque entreprise, créer 2-5 services
                \App\Models\Service::factory(rand(2, 5))->create([
                    'company_id' => $company->id
                ])->each(function ($service) {
                    // Pour chaque service, créer des containers et packages
                    \App\Models\Container::factory(rand(1, 3))->create([
                        'service_id' => $service->id
                    ]);

                    \App\Models\Package::factory(rand(2, 5))->create([
                        'service_id' => $service->id
                    ])->each(function ($user) {
                        // Pour chaque service, créer des containers et packages
                        \App\Models\Container::factory(rand(1, 3))->create([
                            'client_id' => $user->id,
                        ]);

                        \App\Models\Package::factory(rand(2, 5))->create([
                            'client_id' => $user->id
                        ]);
                    });;
                });
            });
        });

        // Créer des destinations et des suivis
        \App\Models\Destination::factory(20)->create();
        \App\Models\PackageTracking::factory(50)->create();
    }
}
