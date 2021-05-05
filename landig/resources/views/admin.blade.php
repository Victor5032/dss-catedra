@extends('layout.layout')

@section('title', "Administradores")

@section('content')
    <header class="pb-3">
        <h3 class="text-center">Administradores</h3>
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
            <a class="btn btn-info" href="{{ route('nuevo') }}">Nuevo admin</a>
        </div>        
        <div class="row">
            <div class="col-12">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Username</th>
                            <th scope="col">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->names }}</td>
                                <td>{{ $item->lastnames }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
