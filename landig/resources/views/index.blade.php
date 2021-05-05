@extends('layout.layout')

@section('title', 'Inicio')

@section('content')
	<h1 class="text-center">Peliculas disponibles</h1>
    <br>
    @if (session('message'))
		<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
			<strong>{{ session('message') }}</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<br>
	@endif
    <div class="row">
        @foreach ($data as $item)
            @if ($item->status === 1)
            <div class="col-4">
                <div class="mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $item->poster }}" class="card-img-top w-100 img-h" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <br>
                            <center>
                                <a href="{{ route('movie', ['movie' => $item->id]) }}" class="btn btn-primary">Ver más</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
@endsection
