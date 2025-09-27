@extends('layouts.app')

@section('content')
    <h1>Registrar Donación</h1>

    <form action="{{ route('donaciones.store') }}" method="POST">
        @csrf

        {{-- Datos generales de la donación --}}
        <label for="tipo">Tipo de Donación:</label>
        <input type="text" name="tipo" required>

        <label for="cantidad">Cantidad (monto, unidades, etc.):</label>
        <input type="number" step="0.01" name="cantidad" required>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="id_adoptante">Adoptante:</label>
        <select name="id_adoptante" required>
            @foreach ($adoptantes as $adoptante)
                <option value="{{ $adoptante->id_adoptante }}">{{ $adoptante->nombres }}</option>
            @endforeach
        </select>

        {{-- Producto (detalle_donacion) --}}
        <h3>Descripción de la donacion</h3>
        <label for="descripcion_producto">Descripción:</label>
        <input type="text" name="descripcion_producto" required>

        <button type="submit" class="btn-guardar mt-3">Guardar</button>
    </form>
@endsection