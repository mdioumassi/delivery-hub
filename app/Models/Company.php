<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    protected $fillable = [
        'name', 'logo_url', 'phone_fixe', 'phone_mobile', 
        'phone_whatssap', 'email', 'street',
        'gestionnaire_id', 'siret', 'city', 'zip_code', 'country', 'is_active',
        'date_dispatch', 'date_delivery', 'total_price', 'comment'
    ];

    // Relation avec l'utilisateur
    public function gestionnaire()
    {
        return $this->belongsTo(Person::class, 'gestionnaire_id');
    }

    public function getGestionnaireNameAttribute()
    {
        return $this->gestionnaire->name;
    }

    // Relation avec les services
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('siret', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
    }
}