<?php namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class Barrio extends Model {
     protected $table = 'barrio'; 
     protected $primaryKey = 'id_barrio'; 
     public $timestamps = false; 
     protected $fillable = ['nombre_barrio', 'id_localidad'];
      
     public function localidad() 
     { 
        return $this->belongsTo(LocalidadUsu::class, 'id_localidad', 'id_localidad'); 
    } }