<?php

namespace App\Enums;

enum ProcessStatus: string
{
    case EnProceso = 'in-process';
    case Pendiente = 'pending';
    case EnRevision = 'in-review';
    case Completado = 'completed';
    case Cancelado = 'canceled';
}
