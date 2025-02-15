<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages'; // Spécifie explicitement le nom de la table

    protected $fillable = [
        'type',
        'weight',
        'unit_price',
        'status',
        'service_id',
        'client_id'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

    public function packageTrackings(): HasMany
    {
        return $this->hasMany(PackageTracking::class);
    }
}