<?php

namespace App\Enums;

enum PackageTypeEnum: string
{
    case DOCUMENT = 'enveloppe';
    case MEDICAMENT = 'medicament';
    case PRODUIT_ALIMENTAIRE = 'produit_alimentaire';
    case COLIS = 'colis';

    public function label(): string
    {
        return match($this) {
            self::DOCUMENT => 'Enveloppe',
            self::MEDICAMENT => 'Médicament',
            self::PRODUIT_ALIMENTAIRE => 'Produit alimentaire',
            self::COLIS => 'Colis'
        };
    }
}
