<?php

namespace App\Enums;

enum ServiceTypeEnum: string
{
    case ENVOI_AVION = 'Envoi par avion';
    case ENVOI_BATEAU = 'Envoi par bateau';
    case ENVOI_ROUTE = 'Envoi par la route';

    public function label(): string
    {
        return match($this) {
            self::ENVOI_AVION => 'Envoi par avion',
            self::ENVOI_BATEAU => 'Envoi par bateau',
            self::ENVOI_ROUTE => 'Envoi par la route',
        };
    } 
}
