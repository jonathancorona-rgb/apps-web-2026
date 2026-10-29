@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="jumbotron text-center py-5">
    <h1 class="display-4">Bienvenido a Aplicaciones Web</h1>
    <p class="lead">Ejemplo de CRUD con Peticiones HTTP en Laravel 12 + Bootstrap 5</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="{{ route('productos.index') }}" role="button">
        Ver Productos
    </a>
</div>
@endsection