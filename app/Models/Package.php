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
        'sender_id',
        'recipient_id',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,);
    }

    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

    public function tracking(): HasMany
    {
        return $this->hasMany(PackageTracking::class);
    }
}