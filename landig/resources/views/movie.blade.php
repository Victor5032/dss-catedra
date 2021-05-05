@extends('layout.layout')

@section('title', $data->title)

@section('content')
    <div class="row">
        <div class="col-4">
            <img class="w-100 h-100" src="{{ $data->poster }}" alt="{{ $data->title }}">
        </div>
        <div class="col-6">
            <div class="container-fluid">
                <h3 class="text-center">{{ $data->title }}</h3>
            </div>
            <br>
            <div class="container-fluid">
                <p>{{ $data->description }}</p>
            </div>
            <div class="container-fluid">
                <h5>
                    <strong>Precio de venta: <span class="text-success">${{ $data->sale_price }}</span></strong>
                    <br>
                    <strong>Precio de alquiler: <span class="text-success">${{ $data->rent_price }}</span></strong>
                </h5>
            </div>
            @if (Cookie::get('Bearer') !== null)
                <br>
                <div class="text-center">
                    <a href="{{ route('alquiler', ['movie' => $data->id]) }}" class="btn btn-info">Alquilar</a>
                    <a href="{{ route('comprar', ['movie' => $data->id]) }}" class="btn btn-success">Comprar</a>
                </div>
            @else
                <br>
                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                    <a href="{{ route('registro') }}" class="btn btn-primary">Registrarme</a>
                </div>
            @endif
        </div>
    </div>
@endsection
