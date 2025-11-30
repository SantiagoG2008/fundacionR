<?php

use App\Http\Controllers\Api\AdopcionApiController;
use App\Http\Controllers\Api\AdoptanteApiController;
use App\Http\Controllers\Api\DonacionApiController;
use App\Http\Controllers\Api\GaleriaApiController;
use App\Http\Controllers\Api\HistoriaClinicaApiController;
use App\Http\Controllers\Api\InformeApiController;
use App\Http\Controllers\Api\MascotaApiController;
use App\Http\Controllers\Api\MensajeApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('mascotas', MascotaApiController::class);
    Route::apiResource('adoptantes', AdoptanteApiController::class);
    Route::apiResource('adopciones', AdopcionApiController::class);
    Route::apiResource('historias-clinicas', HistoriaClinicaApiController::class);
    Route::apiResource('galeria', GaleriaApiController::class);
    Route::apiResource('donaciones', DonacionApiController::class);
    Route::apiResource('mensajes', MensajeApiController::class);
    Route::apiResource('informes', InformeApiController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
});
