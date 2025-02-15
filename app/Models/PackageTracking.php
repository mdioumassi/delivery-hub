<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}