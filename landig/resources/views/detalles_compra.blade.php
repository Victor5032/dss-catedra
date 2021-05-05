@extends('layout.layout')

@section('title', "Detalles de la compra")

@section('content')
    <header class="pb-3">
        <h3 class="text-center">Detalles de la compra</h3>
    </header>
    <br>
    <div class="container-fluid">
        @foreach ($data as $item)
            <div class="card mb-3 w-100" >
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="w-100" src="{{ $item->poster }}" alt="{{ $item->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-center">Pelicula comprada</h5>
                            <br>
                            <h5 class="card-title">Usuario: {{ $item->names }} {{ $item->lastnames }}</h5>
                            <h5 class="card-title">Pelicula: {{ $item->title }}</h5>
                            <h5 class="card-title">Total: <span class="text-success">${{ $item->total }}</span></h5>
                            <br>
                            <p class="card-text text-center">Fecha de compra: <i>{{ date('Y-m-d', strtotime($item->created_at)) }}</i> </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
