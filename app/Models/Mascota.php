<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Raza;
use App\Models\Estado;
use App\Models\DetalleCondicion;
use App\Models\HistoriaClinica;

class Mascota extends Model
{
    protected $table = 'mascota';
    protected $primaryKey = 'id_mascota';
    public $timestamps = false;
    protected $fillable = [
        'nombre_mascota',
        'edad',
        'vacunado',
        'peligroso',
        'esterilizado',
        'destetado',
        'genero',
        'imagen',
        'crianza',
        'fecha_ingreso',
        'condiciones_especiales',
        'raza_id',
        'estado_id',
        'condicion_id'
    ];

    public function raza()
    {
        return $this->belongsTo(Raza::class, 'raza_id', 'id_raza');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id_estado');
    }

    public function condicion()
    {
        return $this->belongsTo(DetalleCondicion::class, 'condicion_id', 'id_condicion');
    }
    public function historiasClinicas()
{
    return $this->hasMany(HistoriaClinica::class, 'id_mascota');
}

    // URL absoluta de la imagen lista para <img src>
    public function getImagenUrlAttribute(): ?string
    {
        if (empty($this->imagen)) {
            return null;
        }

        $ruta = ltrim($this->imagen, '/');

        if (Str::startsWith($ruta, 'storage/')) {
            return '/' . $ruta;
        }

        // Si no existe el archivo indicado, intentar resolver por nombre de mascota con extensiones comunes
        if (!Storage::disk('public')->exists($ruta)) {
            $base = Str::slug($this->nombre_mascota, '_');
            foreach (['jpg', 'jpeg', 'png', 'gif', 'webp'] as $ext) {
                $posible = "imagenes/{$base}.{$ext}";
                if (Storage::disk('public')->exists($posible)) {
                    return '/storage/' . $posible;
                }
            }
        }

        return '/storage/' . $ruta;
    }

}
