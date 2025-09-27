<?php namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class TipoDocum extends Model { 
    protected $table = 'tipo_docum'; 
    protected $primaryKey = 'id_tipo'; 
    public $timestamps = false; 
    protected $fillable = ['nombre_tipo']; }