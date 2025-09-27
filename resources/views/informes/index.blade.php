@extends('layouts.app')

@section('title', 'Informes Generales')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">📊 Informes Generales</h1>
        <div class="page-actions">
            <span class="text-muted">Genera reportes en formato PDF</span>
        </div>
    </div>

    <div class="informes-container">
        <a href="{{ route('donaciones.pdf') }}" class="informe-btn" download>
            <i>🤝</i>
            <div>
                <strong>Informe de Donaciones</strong>
                <small>Reporte completo de todas las donaciones recibidas</small>
            </div>
        </a>

        <a href="{{ route('adoptantes.pdf') }}" class="informe-btn" download>
            <i>👤</i>
            <div>
                <strong>Informe de Adoptantes</strong>
                <small>Listado de personas registradas como adoptantes</small>
            </div>
        </a>

        <a href="{{ route('mascotas.pdf') }}" class="informe-btn" download>
            <i>🐾</i>
            <div>
                <strong>Informe de Mascotas</strong>
                <small>Inventario completo de mascotas en el refugio</small>
            </div>
        </a>

        <a href="{{ route('adopciones.pdf') }}" class="informe-btn" download>
            <i>📝</i>
            <div>
                <strong>Informe de Adopciones</strong>
                <small>Historial de adopciones realizadas</small>
            </div>
        </a>

        <a href="{{ route('historia_clinica.pdf') }}" class="informe-btn" download>
            <i>🩺</i>
            <div>
                <strong>Informe de Historias Clínicas</strong>
                <small>Registros médicos de todas las mascotas</small>
            </div>
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">ℹ️ Información sobre los Informes</h3>
        </div>
        <div class="card-body">
            <p class="card-text">
                Los informes se generan en formato PDF y contienen información actualizada al momento de la descarga. 
                Cada informe incluye datos completos de la sección correspondiente con formato profesional.
            </p>
            <ul style="margin: 15px 0; padding-left: 20px;">
                <li><strong>Donaciones:</strong> Montos, fechas, tipos de donación</li>
                <li><strong>Adoptantes:</strong> Información personal y de contacto</li>
                <li><strong>Mascotas:</strong> Características físicas y estado de salud</li>
                <li><strong>Adopciones:</strong> Fechas, adoptantes y mascotas involucradas</li>
                <li><strong>Historias Clínicas:</strong> Tratamientos y seguimiento médico</li>
            </ul>
        </div>
    </div>
</div>
@endsection
