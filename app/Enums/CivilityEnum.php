<?php

namespace App\Enums;

enum CivilityEnum: string
{
    case Monsieur = 'Mr';
    case Mademoiselle = 'Mlle';
    case Madame = 'Mme';

    public function label(): string
    {
        return match ($this) {
            self::Monsieur => 'Monsieur',
            self::Mademoiselle => 'Mademoiselle',
            self::Madame => 'Madame',
        };
    }
}
