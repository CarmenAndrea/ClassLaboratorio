<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    // Con esta línea le damos permiso a Laravel de guardar estos datos de forma masiva
    protected $fillable = [
        'nombre',
        'codigo_acceso',
        'user_id',
    ];
}
