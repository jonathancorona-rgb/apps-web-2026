@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Listado de productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo Producto
    </a>
</div>

{{-- FILTROS por URL --}}
<form method="GET" action="{{ route('productos.index') }}" class="row g-2 mb-4">
    <div class="col-12 col-md-6">
        <input type="text" name="buscar" value="{{ request('buscar') }}" 
               class="form-control" placeholder="Buscar por nombre...">
    </div>
    <div class="col-8 col-md-4">
        <select name="orden" class="form-select">
            <option value="">Ordenar por...</option>
            <option value="precio_asc" @selected(request('orden') === 'precio_asc')>Precio menor a mayor</option>
            <option value="precio_desc" @selected(request('orden') === 'precio_desc')>Precio mayor a menor</option>
        </select>
    </div>
    <div class="col-4 col-md-2 d-grid d-md-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i> Filtrar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
    </div>
</form>

{{-- MENSAJE flash --}}
@if(session('ok'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('ok') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-end">Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->descripcion ?? 'Sin descripción' }}</td>
                    <td class="text-end">${{ number_format($p->precio, 2) }}</td>
                    <td class="text-center">
                        <a href="{{ route('productos.edit', $p) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        
                        {{-- Opción 1: Botón que abre MODAL --}}
                        <form action="{{ route('productos.destroy', $p) }}" method="POST" class="d-inline" 
      onsubmit="return confirm('¿Seguro que deseas eliminar el producto \"{{ $p->nombre }}\"?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger">
        <i class="bi bi-trash"></i> Eliminar
    </button>
</form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        No hay productos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection