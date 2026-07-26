<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordRequest extends Model
{
    use HasFactory;

    // Aquí le damos permiso a Laravel para registrar el email de golpe
    protected $fillable = [
        'email',
        'status',
    ];
}
