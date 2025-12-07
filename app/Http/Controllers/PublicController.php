<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PublicSite\ContactRequest;
use App\Http\Requests\PublicSite\IdentifierLookupRequest;
use App\Models\Contacto;
use App\Models\Mascota;
use App\Models\Adopcion;
use App\Models\Donacion;
use App\Models\Adoptante;
use App\Models\HistoriaClinica;
use App\Models\Galeria;

class PublicController extends Controller
{
    public function home()
    {
        $mascotas = Mascota::with(['raza', 'estado'])
            ->latest('id_mascota')
            ->take(3)
            ->get();

        $adopciones = Adopcion::with(['mascota', 'adoptante'])
            ->latest('id_adopcion')
            ->take(3)
            ->get();

        $donaciones = Donacion::with('detalles')
            ->latest('id_donacion')
            ->take(3)
            ->get();

        $galeria = Galeria::with('mascota')
            ->latest('id_imagen')
            ->take(6)
            ->get();

        $resumen = [
            'mascotas' => Mascota::count(),
            'adoptantes' => Adoptante::count(),
            'adopciones' => Adopcion::count(),
            'historias clínicas' => HistoriaClinica::count(),
            'donaciones' => Donacion::count(),
            'mensajes' => Contacto::count(),
        ];

        return view('public.home', compact('mascotas', 'adopciones', 'donaciones', 'galeria', 'resumen'));
    }

    public function adopta(IdentifierLookupRequest $request)
    {
        $mascotas = Mascota::with(['raza', 'estado'])
            ->orderByDesc('fecha_ingreso')
            ->paginate(12);

        $adopciones = null;
        $miMascota = null;
        $historias = collect();
        $lookupAttempted = $request->filled('identificador');
        $identifier = $request->validated()['identificador'] ?? null;

        if ($lookupAttempted) {
            $adoptante = $this->findAdoptanteByIdentifier($identifier);

            if ($adoptante) {
                // Solicitudes de ese adoptante
                $adopciones = Adopcion::with('mascota')
                    ->where('id_adoptante', $adoptante->id_adoptante)
                    ->orderByDesc('id_adopcion')
                    ->get();

                // Última mascota adoptada y su historia clínica
                $adopcionReciente = $adopciones->first();
                if ($adopcionReciente && $adopcionReciente->mascota) {
                    $miMascota = $adopcionReciente->mascota->load(['raza', 'estado']);
                    $historias = $miMascota->historiasClinicas()
                        ->orderByDesc('fecha_chequeo')
                        ->get();
                }
            } else {
                $adopciones = collect();
            }
        }

        return view('public.adopta', compact('mascotas', 'adopciones', 'miMascota', 'historias', 'lookupAttempted'));
    }

    public function donar(IdentifierLookupRequest $request)
    {
        $donacionesUsuario = null;

        if ($request->filled('identificador')) {
            $identifier = $request->validated()['identificador'] ?? null;
            $adoptante = $this->findAdoptanteByIdentifier($identifier);

            $donacionesUsuario = $adoptante
                ? Donacion::with('detalles')
                    ->where('id_adoptante', $adoptante->id_adoptante)
                    ->orderByDesc('id_donacion')
                    ->get()
                : collect();
        }

        return view('public.donar', compact('donacionesUsuario'));
    }

    public function quienesSomos()
    {
        return view('public.quienes-somos');
    }

    public function contacto(Request $request)
    {
        $mascotaSeleccionada = null;

        if ($request->filled('mascota')) {
            $mascotaSeleccionada = Mascota::find($request->input('mascota'));
        }

        return view('public.contacto', compact('mascotaSeleccionada'));
    }

    public function storeContacto(ContactRequest $request)
    {
        Contacto::create($request->validated());

        return redirect()->route('contacto')->with('success', '¡Gracias por tu mensaje! Te contactaremos pronto.');
    }

    public function voluntarios()
    {
        return view('public.voluntarios');
    }

    public function padrinos()
    {
        return view('public.padrinos');
    }

    public function casosEspeciales()
    {
        return view('public.casos-especiales');
    }

    public function canalesDonacion()
    {
        return view('public.canales-donacion');
    }

    public function galeria()
    {
        $galeria = Galeria::with('mascota')
            ->latest('id_imagen')
            ->get();

        return view('public.galeria', compact('galeria'));
    }

    private function findAdoptanteByIdentifier(?string $identifier): ?Adoptante
    {
        if (!filled($identifier)) {
            return null;
        }

        return Adoptante::where('correo', $identifier)
            ->orWhere('nro_docum', $identifier)
            ->first();
    }
}
