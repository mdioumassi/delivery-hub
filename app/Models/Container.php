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
        'type', 'unit_price', 'description', 'status', 'service_id', 'client_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'unit_price' => 'decimal:2'
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
}