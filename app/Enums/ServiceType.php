<?php

namespace App\Enums;

enum ServiceType: string
{
    case envoi_aerien = 'Envoi aèrien';
    case envoi_maritim = 'Envoi maritime';
    case envoi_routier = 'Envoi terrestre';
}
