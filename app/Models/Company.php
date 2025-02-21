<?php

// app/Models/Company.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo_url', 'phone_fixe', 'phone_mobile', 
        'phone_whatssap', 'email', 'street',
        'gestionnaire_id', 'siret', 'city', 'zip_code', 'country'
    ];

    // Relation avec l'utilisateur
    public function gestionnaire()
    {
        return $this->belongsTo(User::class, 'gestionnaire_id');
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

    // Relation avec les destinations
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }
}