@extends('layout.layout')

@section('title', $title)

@section('content')
    <header class="pb-3">
        <h3 class="text-center">{{ $title }}</h3>
    </header>
    <br>
    <div class="container-fluid">       
        <div class="row">
            <div class="col-12">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            @if (Cookie::get('is_admin') == 1)
                                <th scope="col">Usuario</th>
                            @endif
                            <th scope="col">Total</th>
                            <th scope="col">Pelicula</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if (isset($data['message']))
                            <tr>
                                <td colspan="5">
                                    <span class="text-danger">
                                        <strong>{{ $data['message'] }}</strong>
                                    </span>
                                </td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    @if (isset($item->names))
                                        <td>{{ $item->names }} {{ $item->lastnames }}</td>
                                    @endif
                                    <td>${{ $item->total }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('detallescompra', ['sale' => $item->id]) }}" class="btn btn-info">Ver detalles</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
