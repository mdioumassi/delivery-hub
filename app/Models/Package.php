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
        'tracking_number',
        'type',
        'weight',
        'unit_price',
        'status',
        'service_id',
        'sender_id',
        'recipient_id',
    ];

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        // Avant la création d'un nouvel enregistrement
        static::creating(function ($package) {
            // Générer automatiquement un numéro de suivi s'il n'est pas défini
            if (empty($package->tracking_number)) {
                $package->tracking_number = self::generateTrackingNumber();
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
        $prefix = 'FR-' . date('Ymd');

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

    /**
     * Génère un QR code pour le numéro de suivi
     *
     * @return string URL de l'image QR code
     */
    public function getQrCodeAttribute()
    {
        // Utiliser une API externe ou une bibliothèque pour générer un QR code
        return 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $this->tracking_number;
    }

    /**
     * Génère un code-barres pour le numéro de suivi
     *
     * @return string URL de l'image du code-barres
     */
    public function getBarcodeAttribute()
    {
        // Pour une implémentation plus robuste, vous pourriez utiliser une bibliothèque comme
        // picqer/php-barcode-generator ou installer intervention/image
        return 'https://barcode.tec-it.com/barcode.ashx?data=' . $this->tracking_number . '&code=Code128&multiplebarcodes=false&translate-esc=true&unit=Fit&dpi=96&imagetype=Png&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=&qunit=Mm&quiet=0';
    }

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
