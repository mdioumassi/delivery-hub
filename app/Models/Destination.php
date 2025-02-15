<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'country', 'package_id', 'container_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function packageTrackings()
    {
        return $this->hasMany(PackageTracking::class);
    }
}