<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'completada',
        'fecha_limite',
    ];
}
