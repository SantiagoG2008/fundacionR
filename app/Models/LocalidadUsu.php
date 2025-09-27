<?php namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class LocalidadUsu extends Model { 
    protected $table = 'localidad_usu'; 
    protected $primaryKey = 'id_localidad'; 
    public $timestamps = false; 
    protected $fillable = ['nombre_localidad'];  

    public function barrios() { 
        return $this->hasMany(Barrio::class, 'id_localidad', 'id_localidad'); 
    } }