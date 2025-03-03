<?php

namespace App\Enums;

enum CivilityEnum: string
{
    case MONSIEUR = 'mr';
    case MADEMOISELLE = 'mlle';
    case MADAME = 'mme';

    public function label(): string
    {
        return match($this) {
            self::MONSIEUR => 'Monsieur',
            self::MADEMOISELLE => 'Mademoiselle',
            self::MADAME => 'Madame',
        };
    }
}
