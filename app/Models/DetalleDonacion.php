<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDonacion extends Model
{
    protected $table      = 'detalle_donacion';
    protected $primaryKey = 'id_detalle';

    protected $fillable = ['id_donacion', 'descripcion_producto'];

    public function donacion()
    {
        return $this->belongsTo(Donacion::class, 'id_donacion');
    }
}
