<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Auditoria::query()->orderBy('created_at', 'desc');

        if ($request->filled('modulo')) {
            $query->where('modulo', $request->modulo);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        $auditorias = $query->paginate(20);

        $modulos = Auditoria::select('modulo')
            ->distinct()
            ->orderBy('modulo')
            ->pluck('modulo');

        return view('auditoria.index', compact('auditorias', 'modulos'));
    }
}

