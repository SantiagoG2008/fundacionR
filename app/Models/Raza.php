<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mascota;

class Raza extends Model
{
    protected $table = 'razas';
    protected $primaryKey = 'id_raza';
    public $timestamps = false;
    protected $fillable = ['nombre_raza'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'raza_id', 'id_raza');
    }
}
