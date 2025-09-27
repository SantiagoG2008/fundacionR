@extends('layouts.app')

@section('content')
    <h1>Editar Donación</h1>

    <form action="{{ route('donaciones.update', $donacion->id_donacion) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Datos generales --}}
        <label for="tipo">Tipo de Donación:</label>
        <input type="text" name="tipo" value="{{ $donacion->tipo }}" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" step="0.01" name="cantidad" value="{{ $donacion->cantidad }}" required>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="{{ $donacion->fecha }}" required>

        <label for="id_adoptante">Adoptante:</label>
        <select name="id_adoptante" required>
            @foreach ($adoptantes as $adoptante)
                <option value="{{ $adoptante->id_adoptante }}" {{ $donacion->id_adoptante == $adoptante->id_adoptante ? 'selected' : '' }}>
                    {{ $adoptante->nombres }}
                </option>
            @endforeach
        </select>

        {{-- Único detalle asociado --}}
        @php $detalle = $donacion->detalles->first(); @endphp
        <h3>Descripción del Producto Donado</h3>
        <label for="descripcion_producto">Descripción:</label>
        <input type="text" name="descripcion_producto" value="{{ $detalle->descripcion_producto ?? '' }}" required>

        <button type="submit" class="btn-guardar mt-3">Actualizar</button>
    </form>
@endsection
