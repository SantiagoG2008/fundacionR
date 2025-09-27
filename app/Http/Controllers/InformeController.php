<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Models\Adoptante;
use App\Models\Mascota;
use App\Models\Adopcion;
use App\Models\HistoriaClinica;
use Barryvdh\DomPDF\Facade\Pdf;

class InformeController extends Controller
{
    public function index()
    {
        return view('informes.index');
    }

    public function donacionesPDF()
    {
        $donaciones = Donacion::with(['adoptante', 'detalles'])->get();
        $pdf = Pdf::loadView('informes.donaciones_pdf', compact('donaciones'));
        return $pdf->download('informe_donaciones.pdf');
    }

    public function adoptantesPDF()
    {
        $adoptantes = Adoptante::with(['tipoDocumento', 'localidad', 'barrio'])->get();
        $pdf = Pdf::loadView('informes.adoptantes_pdf', compact('adoptantes'));
        return $pdf->download('informe_adoptantes.pdf');
    }

    public function mascotasPDF()
    {
        $mascotas = Mascota::with(['raza', 'estado', 'condicion'])->get();
        $pdf = Pdf::loadView('informes.mascotas_pdf', compact('mascotas'));
        return $pdf->download('informe_mascotas.pdf');
    }

    public function adopcionesPDF()
    {
        $adopciones = Adopcion::with(['mascota', 'adoptante'])->get();
        $pdf = Pdf::loadView('informes.adopciones_pdf', compact('adopciones'));
        return $pdf->download('informe_adopciones.pdf');
    }

    public function historiasPDF()
    {
        $historias = HistoriaClinica::with('mascota')->get();
        $pdf = Pdf::loadView('informes.historias_pdf', compact('historias'));
        return $pdf->download('informe_historias.pdf');
    }
}
