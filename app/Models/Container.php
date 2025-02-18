<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'unit_price', 'status', 'service_id', 'sender_id', 'recipient_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'unit_price' => 'decimal:2'
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
        return $this->belongsTo(Service::class);
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