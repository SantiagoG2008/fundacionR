<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelConfig extends Model
{
    use HasFactory;

    protected $table = 'panel_config';
    protected $primaryKey = 'id_config';
    public $timestamps = true;

    protected $fillable = [
        'clave',
        'valor',
    ];

    protected $casts = [
        'valor' => 'boolean',
    ];

    public static function isPanelActive(): bool
    {
        $config = self::where('clave', 'panel_activo')->first();
        return $config ? (bool) $config->valor : false;
    }

    public static function setPanelActive(bool $active): void
    {
        self::updateOrCreate(
            ['clave' => 'panel_activo'],
            ['valor' => $active]
        );
    }
}
