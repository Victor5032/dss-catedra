@extends('layout.layout')

@section('title', 'Inventario')

@section('content')
    <header class="pb-3">
        <h3 class="text-center">Inventario</h3>
    </header>
    <br>
    @if (session('message'))
		<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
			<strong>{{ session('message') }}</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<br>
	@endif
    <div class="container-fluid">
        <div class="pb-3">
            <a class="btn btn-info" href="{{ route('agregar') }}">Ingresar pelicula</a>
        </div>        
        <div class="row">
            <div class="col-12">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Precio venta</th>
                            <th scope="col">Precio alquiler</th>
                            <th scope="col">Unidades disponibles</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->title }}</td>
                                <td>${{ $item->sale_price }}</td>
                                <td>${{ $item->rent_price }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="text-success">
                                            <strong>Activo</strong>
                                        </span>
                                    @else
                                        <span class="text-warning">
                                            <strong>Inactivo</strong>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <a href="{{ route('editar', ['movie' => $item->id]) }}" class="btn btn-info">Editar</a>
                                        </div>
                                        <div class="col-4">
                                            @if ($item->status == 1)
                                                <a href="{{ route('inhabilitar', ['movie' => $item->id, 'action' => 'remove']) }}" class="btn btn-warning">Inhabilitar</a>
                                            @else
                                                <a href="{{ route('inhabilitar', ['movie' => $item->id, 'action' => 'add']) }}" class="btn btn-success">Habilitar</a>
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('eliminar', ['movie' => $item->id]) }}" class="btn btn-danger">Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
