<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoptante extends Model
{
    protected $table = 'adoptantes';
    protected $primaryKey = 'id_adoptante';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'telefono',
        'direccion',
        'edad',
        'nro_docum',
        'correo',
        'sexo',
        'id_localidad',
        'id_barrio',
        'id_tipo',
        'rol',
    ];

    // Relaciones
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocum::class, 'id_tipo', 'id_tipo');
    }

    public function localidad()
    {
        return $this->belongsTo(LocalidadUsu::class, 'id_localidad', 'id_localidad');
    }

   public function barrio()
{
    return $this->belongsTo(Barrio::class, 'id_barrio');
}

}
