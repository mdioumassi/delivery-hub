

# Générer les controllers API avec resources
php artisan make:controller API/UserController --api --model=User
php artisan make:controller API/CompanyController --api --model=Company
php artisan make:controller API/ServiceController --api --model=Service
php artisan make:controller API/ContainerController --api --model=Container
php artisan make:controller API/PackageController --api --model=Package
php artisan make:controller API/DestinationController --api --model=Destination
php artisan make:controller API/PackageTrackingController --api --model=PackageTracking

# Générer les routes API dans routes/api.php
# Ajoutez ces lignes dans le fichier routes/api.php:

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\ContainerController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\API\PackageTrackingController;

Route::apiResource('users', UserController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('containers', ContainerController::class);
Route::apiResource('packages', PackageController::class);
Route::apiResource('destinations', DestinationController::class);
Route::apiResource('package-tracking', PackageTrackingController::class);

# Ces routes vont automatiquement créer les endpoints suivants pour chaque resource:
# GET /api/resource - Index (liste)
# POST /api/resource - Store (créer)
# GET /api/resource/{id} - Show (afficher)
# PUT/PATCH /api/resource/{id} - Update (modifier)
# DELETE /api/resource/{id} - Destroy (supprimer)

# Générer des données de test avec les factories et seeders
php artisan make:factory UserFactory --model=User
php artisan make:factory CompanyFactory --model=Company
php artisan make:factory ServiceFactory --model=Service
php artisan make:factory ContainerFactory --model=Container
php artisan make:factory PackageFactory --model=Package
php artisan make:factory DestinationFactory --model=Destination
php artisan make:factory PackageTrackingFactory --model=PackageTracking

php artisan make:seeder UsersTableSeeder
php artisan make:seeder CompaniesTableSeeder
php artisan make:seeder ServicesTableSeeder
php artisan make:seeder ContainersTableSeeder
php artisan make:seeder PackagesTableSeeder
php artisan make:seeder DestinationsTableSeeder
php artisan make:seeder PackageTrackingTableSeeder

php artisan make:controller UserController --resource
php artisan make:controller CompanyController --resource
php artisan make:controller ServiceController --resource
php artisan make:controller ContainerController --resource
php artisan make:controller PackageController --resource
php artisan make:controller PackageTrackingController --resource
php artisan make:controller DestinationController --resource