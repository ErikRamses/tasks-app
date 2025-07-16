<?php

namespace App\Enums;

enum ProcessPriority: string
{
    case Baja = 'low';
    case Media = 'medium';
    case Alta = 'high';
    case Urgente = 'urgent';
}
