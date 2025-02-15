<?php
// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'description', 'is_active', 
        'company_id',
    ];

    protected $casts = ['is_active' => 'boolean'];

    // Relation avec l'entreprise
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relation avec les conteneurs
    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    // Relation avec les colis
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}