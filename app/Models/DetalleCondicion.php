<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mascota;

class DetalleCondicion extends Model
{
    protected $table = 'detalle_condicion';
    protected $primaryKey = 'id_condicion';
    public $timestamps = false;
    protected $fillable = ['descripcion'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'condicion_id', 'id_condicion');
    }
}
