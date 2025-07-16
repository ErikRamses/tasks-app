<?php
namespace App\Enums;

enum UserStatus: string
{
    case Pendiente = 'pending';
    case Incompleto = 'incomplete';
    case Aprobado = 'approved';
    case Validando = 'validating';
    case Validado = 'validated';
}
