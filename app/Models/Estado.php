<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mascota;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    public $timestamps = false;
    protected $fillable = ['descripcion'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'estado_id', 'id_estado');
    }
}
