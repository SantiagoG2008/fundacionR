<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Mascota;

class Galeria extends Model
{
    use HasFactory;

    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagen'; 
    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'nombre',
        'peso',
        'ruta',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }

    // URL absoluta de la imagen en galería
    public function getRutaUrlAttribute(): ?string
    {
        if (empty($this->ruta)) {
            return null;
        }
        $ruta = ltrim($this->ruta, '/');
        if (Str::startsWith($ruta, ['http://', 'https://', 'storage/'])) {
            return Str::startsWith($ruta, ['http://', 'https://']) ? $ruta : '/' . $ruta;
        }
        return '/storage/' . $ruta;
    }
}
