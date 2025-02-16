<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageTracking extends Model
{
    use HasFactory;
    
    protected $table = 'package_trackings'; // Spécifiez le nom de la table

    protected $fillable = [
        'package_id', 'container_id', 'destination_id',
        'tracking_date', 'status', 'notes'
    ];

    protected $casts = [
        'tracking_date' => 'date',
        'status' => 'boolean'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}