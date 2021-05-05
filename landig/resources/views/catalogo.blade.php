@extends('layout.layout')

@section('title', 'Catalogo')

@section('content')
    <header class="pb-3">
        <h3 class="text-center">Catalogo</h3>
    </header>
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $item)
                @if ($item->status === 1)
                    <div class="col-6">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="w-100 h-100" src="{{ $item->poster }}" alt="{{ $item->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text">{{ $item->description }}</p>
                                        <a href="{{ route('movie', ['movie' => $item->id]) }}" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach            
        </div>
    </div>
@endsection
