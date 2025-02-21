<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'country', 'departure_date', 'arrival_date', 'company_id','package_id', 'container_id'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tracking(): HasMany
    {
        return $this->hasMany(PackageTracking::class);
    }
}