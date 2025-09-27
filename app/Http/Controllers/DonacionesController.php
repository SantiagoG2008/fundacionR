<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Models\DetalleDonacion;
use App\Models\Adoptante;
use Illuminate\Http\Request;          // 👈 ésta es la importación correcta
use Illuminate\Support\Facades\DB;

class DonacionesController extends Controller
{
    /* ─────────────────────────────
       LISTAR DONACIONES
    ───────────────────────────── */
    public function index()
    {
        // Cargamos adoptante y el único detalle (relación 1-N pero usaremos first())
        $donaciones = Donacion::with(['adoptante', 'detalles'])
                              ->latest()
                              ->paginate(10);

        return view('donaciones.index', compact('donaciones'));
    }

    /* ─────────────────────────────
       FORMULARIO CREATE
    ───────────────────────────── */
    public function create()
    {
        $adoptantes = Adoptante::all();
        return view('donaciones.create', compact('adoptantes'));
    }

    /* ─────────────────────────────
       GUARDAR NUEVA DONACIÓN
    ───────────────────────────── */
    public function store(Request $request)
    {
        $request->validate([
            'tipo'                 => 'required|string|max:255',
            'cantidad'             => 'required|numeric',
            'fecha'                => 'required|date',
            'id_adoptante'         => 'required|exists:adoptantes,id_adoptante',
            'descripcion_producto' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            // 1) guardar donación principal
            $donacion = Donacion::create(
                $request->only('tipo', 'cantidad', 'fecha', 'id_adoptante')
            );

            // 2) guardar su único detalle
            $donacion->detalles()->create([
                'descripcion_producto' => $request->descripcion_producto,
            ]);
        });

        return redirect()->route('donaciones.index')
                         ->with('success', 'Donación registrada correctamente.');
    }

    /* ─────────────────────────────
       FORMULARIO EDIT
    ───────────────────────────── */
    public function edit(Donacion $donacion)
    {
        $adoptantes = Adoptante::all();
        $donacion->load('detalles');          // trae descripción para mostrarla
        return view('donaciones.edit', compact('donacion', 'adoptantes'));
    }

    /* ─────────────────────────────
       ACTUALIZAR DONACIÓN
    ───────────────────────────── */
    public function update(Request $request, Donacion $donacion)
    {
        $request->validate([
            'tipo'                 => 'required|string|max:255',
            'cantidad'             => 'required|numeric',
            'fecha'                => 'required|date',
            'id_adoptante'         => 'required|exists:adoptantes,id_adoptante',
            'descripcion_producto' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $donacion) {
            // 1) actualizar donación
            $donacion->update(
                $request->only('tipo', 'cantidad', 'fecha', 'id_adoptante')
            );

            // 2) reemplazar (o crear) el detalle
            $donacion->detalles()->delete();
            $donacion->detalles()->create([
                'descripcion_producto' => $request->descripcion_producto,
            ]);
        });

        return redirect()->route('donaciones.index')
                         ->with('success', 'Donación actualizada correctamente.');
    }

    /* ─────────────────────────────
       ELIMINAR DONACIÓN
    ───────────────────────────── */
    public function destroy(Donacion $donacion)
    {
        $donacion->delete();   // onDelete('cascade') borra detalle
        return redirect()->route('donaciones.index')
                         ->with('success', 'Donación eliminada correctamente.');
    }
}
