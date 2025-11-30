<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InformeResumenResource;
use App\Models\Adopcion;
use App\Models\Adoptante;
use App\Models\Contacto;
use App\Models\Donacion;
use App\Models\Galeria;
use App\Models\HistoriaClinica;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class InformeApiController extends Controller
{
    public function index()
    {
        $summary = Cache::remember('informes.resumen', 60, fn () => $this->buildSummary());

        return new InformeResumenResource($summary);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ]);

        $summary = $this->buildSummary($data['from'] ?? null, $data['to'] ?? null);

        return (new InformeResumenResource($summary))
            ->additional(['filters' => $data]);
    }

    public function show($tipo)
    {
        $collection = match ($tipo) {
            'mascotas' => Mascota::with('raza')->latest('id_mascota')->take(10)->get(),
            'adoptantes' => Adoptante::with(['localidad', 'barrio'])->latest('id_adoptante')->take(10)->get(),
            'adopciones' => Adopcion::with(['mascota', 'adoptante'])->latest('id_adopcion')->take(10)->get(),
            'historias' => HistoriaClinica::with('mascota')->latest('id_historia')->take(10)->get(),
            'galeria' => Galeria::with('mascota')->latest('id_imagen')->take(12)->get(),
            'donaciones' => Donacion::with(['adoptante', 'detalles'])->latest('id_donacion')->take(10)->get(),
            'mensajes' => Contacto::latest()->take(10)->get(),
            default => collect(),
        };

        return response()->json([
            'type' => $tipo,
            'total' => $collection->count(),
            'data' => $collection,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Reuse store logic but include identifier in response
        $response = $this->store($request);
        $payload = $response->getData(true);
        $payload['report_id'] = $id;

        return response()->json($payload);
    }

    public function destroy($id)
    {
        Cache::forget('informes.resumen');

        return response()->json(['message' => "Resumen {$id} invalidado."]);
    }

    protected function buildSummary(?string $from = null, ?string $to = null): array
    {
        return [
            'mascotas' => $this->countWithDates(Mascota::query(), 'fecha_ingreso', $from, $to),
            'adoptantes' => Adoptante::count(),
            'adopciones' => $this->countWithDates(Adopcion::query(), 'fecha_adopcion', $from, $to),
            'historias_clinicas' => $this->countWithDates(HistoriaClinica::query(), 'fecha_chequeo', $from, $to),
            'galeria' => $this->countWithDates(Galeria::query(), 'created_at', $from, $to, true),
            'donaciones' => $this->countWithDates(Donacion::query(), 'fecha', $from, $to),
            'mensajes' => $this->countWithDates(Contacto::query(), 'created_at', $from, $to, true),
        ];
    }

    protected function countWithDates($query, string $column, ?string $from, ?string $to, bool $hasTimestamps = false): int
    {
        if (!$hasTimestamps && !Schema::hasColumn($query->getModel()->getTable(), $column)) {
            return $query->count();
        }

        return $query
            ->when($from, fn ($q) => $q->whereDate($column, '>=', $from))
            ->when($to, fn ($q) => $q->whereDate($column, '<=', $to))
            ->count();
    }
}

