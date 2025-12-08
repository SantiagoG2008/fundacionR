<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Donacion extends Model
{
    use Auditable;
    protected $table      = 'donaciones';
    protected $primaryKey = 'id_donacion';

    protected $fillable = ['tipo', 'cantidad', 'fecha', 'id_adoptante'];

    public function detalles()    // 1-a-muchos
    {
        return $this->hasMany(DetalleDonacion::class, 'id_donacion');
    }

    public function adoptante()   // opcional, por si lo usas
    {
        return $this->belongsTo(Adoptante::class, 'id_adoptante');
    }
}