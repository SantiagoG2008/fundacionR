<?php

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AdoptanteController;
use App\Http\Controllers\DetalleDonacionController;
use App\Http\Controllers\DonacionesController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Storage;

// Rutas públicas (frontend)
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/adopta', [PublicController::class, 'adopta'])->name('adopta');
Route::get('/donar', [PublicController::class, 'donar'])->name('donar');
Route::get('/quienes-somos', [PublicController::class, 'quienesSomos'])->name('quienes-somos');
Route::get('/contacto', [PublicController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [PublicController::class, 'storeContacto'])->name('contacto.store');
Route::get('/voluntarios', [PublicController::class, 'voluntarios'])->name('voluntarios');
Route::get('/padrinos', [PublicController::class, 'padrinos'])->name('padrinos');
Route::get('/casos-especiales', [PublicController::class, 'casosEspeciales'])->name('casos-especiales');
Route::get('/canales-donacion', [PublicController::class, 'canalesDonacion'])->name('canales-donacion');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas administrativas (protegidas)
Route::middleware(['simple.auth'])->group(function () {
    Route::get('/admin', fn () => redirect()->route('mascotas.index'))->name('admin.dashboard');
    
    Route::resource('mascotas', MascotaController::class);
    Route::resource('historia_clinicas', HistoriaClinicaController::class); 
    Route::resource('galeria', GaleriaController::class);
    Route::resource('adopciones', AdopcionController::class)->parameters(['adopciones' => 'adopcion']);
    Route::resource('adoptantes', AdoptanteController::class);
    Route::resource('donaciones', DonacionesController::class)->parameters(['donaciones' => 'donacion']);
    Route::resource('contactos', ContactoController::class);

    // Informes
    Route::get('/informes', [InformeController::class, 'index'])->name('informes.index');
    Route::get('/informes/mascotas/pdf', [InformeController::class, 'mascotasPDF'])->name('mascotas.pdf');
    Route::get('/informes/adoptantes/pdf', [InformeController::class, 'adoptantesPDF'])->name('adoptantes.pdf');
    Route::get('/informes/donaciones/pdf', [InformeController::class, 'donacionesPDF'])->name('donaciones.pdf');
    Route::get('/informes/adopciones/pdf', [InformeController::class, 'adopcionesPDF'])->name('adopciones.pdf');
    Route::get('/informes/historias/pdf', [InformeController::class, 'historiasPDF'])->name('historia_clinica.pdf');
});

// Fallback para servir archivos del disco 'public' cuando el symlink falla (Windows/rutas con espacios)
Route::get('/storage/{path}', function (string $path) {
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return Storage::disk('public')->response($path);
})->where('path', '.*');
