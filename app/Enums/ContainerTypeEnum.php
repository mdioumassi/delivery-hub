<?php

namespace App\Enums;

enum ContainerTypeEnum: string
{
    case FCL = 'full_container_load';
    case LCl = 'less_than_container_load';
    case COLIS = 'colis';

    public function label(): string
    {
        return match($this) {
            self::FCL => 'Reservez un conteneur complet',
            self::LCl => 'Reservez un conteneur partiel',
            self::COLIS => 'Reservez un colis individuel'
        };
    }
}
