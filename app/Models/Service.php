<?php
// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'description', 'is_active', 'company_id',
    ];

    protected $casts = ['is_active' => 'boolean'];

    // Relation avec l'entreprise
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // Relation avec les conteneurs
    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }

    // Relation avec les colis
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    // Relation avec les destinations
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }
}