<?php

namespace App\Traits;

use App\Models\Auditoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function ($model) {
            static::registrarAuditoria($model, 'created');
        });

        static::updated(function ($model) {
            static::registrarAuditoria($model, 'updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            static::registrarAuditoria($model, 'deleted', $model->getOriginal());
        });
    }

    protected static function registrarAuditoria($model, $accion, $valoresAnteriores = null, $valoresNuevos = null)
    {
        try {
            $modulo = static::obtenerNombreModulo($model);
            $tabla = $model->getTable();
            $registroId = $model->getKey();
            
            $usuario = 'Sistema';
            if (Auth::check()) {
                $user = Auth::user();
                $usuario = $user->email ?? $user->name ?? $user->id ?? 'Usuario Autenticado';
            }
            
            $valoresAnt = null;
            if ($valoresAnteriores) {
                $valoresAnt = json_encode($valoresAnteriores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            
            $valoresNue = null;
            if ($accion === 'created') {
                $valoresNue = json_encode($model->getAttributes(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } elseif ($valoresNuevos) {
                $valoresNue = json_encode($valoresNuevos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            
            Auditoria::create([
                'modulo' => $modulo,
                'tabla' => $tabla,
                'registro_id' => $registroId,
                'accion' => $accion,
                'usuario' => $usuario,
                'valores_anteriores' => $valoresAnt,
                'valores_nuevos' => $valoresNue,
                'ip' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al registrar auditoría: ' . $e->getMessage());
        }
    }

    protected static function obtenerNombreModulo($model)
    {
        $className = class_basename($model);
        $modulos = [
            'Mascota' => 'Mascotas',
            'Adoptante' => 'Adoptantes',
            'Adopcion' => 'Adopciones',
            'HistoriaClinica' => 'Historias Clínicas',
            'Galeria' => 'Galería',
            'Donacion' => 'Donaciones',
            'Contacto' => 'Mensajes',
        ];
        
        return $modulos[$className] ?? $className;
    }
}

