@extends('layouts.app')

@section('title', 'Nuevo Producto')

@section('content')
<h1 class="mb-4">Agregar Producto</h1>

<form action="{{ route('productos.store') }}" method="POST" novalidate>
    @csrf
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" 
               value="{{ old('nombre') }}"
               class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="3"
                  class="form-control">{{ old('descripcion') }}</textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio"
                   value="{{ old('precio') }}"
                   class="form-control @error('precio') is-invalid @enderror">
            @error('precio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad"
                   value="{{ old('cantidad') }}"
                   class="form-control @error('cantidad') is-invalid @enderror">
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Guardar
    </button>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Cancelar
    </a>
</form>
@endsection