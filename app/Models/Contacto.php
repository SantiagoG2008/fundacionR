<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Contacto extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'nombre',
        'email',
        'asunto',
        'mensaje',
        'leido'
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];
}
