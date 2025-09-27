<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    protected $table = 'adopciones';
    protected $primaryKey = 'id_adopcion';

    protected $fillable = [
        'id_mascota',
        'id_adoptante',
        'fecha_adopcion',
        'observaciones',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id_mascota');
    }

    public function adoptante()
    {
        return $this->belongsTo(Adoptante::class, 'id_adoptante', 'id_adoptante');
    }
}
