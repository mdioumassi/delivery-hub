<?php

namespace App\Enums;

enum PersonTypeEnum: string
{
    case ADMIN = 'admin';
    case GESTIONNAIRE = 'gestionnaire';
    case SENDER = 'expediteur';
    case RECEIVER = 'destinataire';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrateur',
            self::GESTIONNAIRE => 'Gestionnaire',
            self::SENDER => 'Expéditeur',
            self::RECEIVER => 'Destinataire',
        };
    }
}
