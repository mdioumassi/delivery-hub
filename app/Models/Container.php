<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Container extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'type',
                'onUpdate' => true
            ]
        ];
    }

    protected $fillable = [
        'type', 
        'unit_price', 
        'status', 
        'service_id', 
        'sender_id', 
        'recipient_id', 
        'comment', 
        'date_dispatch', 
        'date_delivery', 
        'total_price'
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

        /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        // Avant la création d'un nouvel enregistrement
        static::creating(function ($container) {
            // Générer automatiquement un numéro de suivi s'il n'est pas défini
            if (empty($container->tracking_number)) {
                $container->tracking_number = self::generateTrackingNumber();
            }
        });
    }

    /**
     * Génère un numéro de suivi unique
     * Format: FR-YYYYMMDD-XXXXX (où XXXXX est un nombre séquentiel)
     *
     * @return string
     */
    public static function generateTrackingNumber()
    {
        // Préfixe du pays et date du jour
        $prefix = 'CON-' . date('Ymd');

        // Récupérer le dernier numéro utilisé aujourd'hui
        $lastPackage = self::where('tracking_number', 'like', $prefix . '-%')
            ->orderBy('tracking_number', 'desc')
            ->first();

        if ($lastPackage) {
            // Extraire le numéro séquentiel et l'incrémenter
            $parts = explode('-', $lastPackage->tracking_number);
            $sequentialNumber = intval($parts[2]) + 1;
        } else {
            // Premier colis de la journée
            $sequentialNumber = 1;
        }

        // Formater avec des zéros à gauche (5 chiffres: 00001, 00002, etc.)
        $formattedNumber = str_pad($sequentialNumber, 5, '0', STR_PAD_LEFT);

        // Assembler le numéro de suivi complet
        $trackingNumber = $prefix . '-' . $formattedNumber;

        return $trackingNumber;
    }
}