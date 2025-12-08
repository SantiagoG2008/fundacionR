<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mascota;
use App\Traits\Auditable;

class HistoriaClinica extends Model
{
    use HasFactory, Auditable;

    protected $table = 'historia_clinica';

    protected $primaryKey = 'id_historia'; 

    protected $fillable = [
        'id_mascota',
        'fecha_chequeo',
        'peso',
        'tratamiento',
        'observaciones',
        'cuidados',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }
}
