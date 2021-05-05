@extends('layout.layout')

@section('title', 'Mi perfil')

@section('content')
    <header class="pb-3">
        <h3 class="text-center">Mi perfil</h3>
    </header>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <h3>Datos</h3>
                <br>
                <div class="container-fluid">
                    <form>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <label for="nombres_label">Nombres:</label>
                                        <input type="text" class="form-control" id="names" name="names" value="{{ $data['names'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <label for="apellidos_label">Apellidos:</label>
                                        <input type="text" class="form-control" id="lastnames" name="lastnames" value="{{ $data['lastnames'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <label for="usuario_label">Nombre de usuario:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $data['username'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="email_label">Correo electronico:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $data['email'] }}" readonly>
                        </div>
                        <button class="btn btn-info" type="submit" disabled>Actualizar</button>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="card w-100">
                    <div class="card-header">
                        <h4 class="text-center">Preview</h4>
                    </div>
                    <div class="card-body">
                        <center>
                            <img src="https://stafforgserv.com.au/wp-content/uploads/2018/09/user-img.png" alt="User" style="width: 60%;">
                        </center>
                        <br>
                        <center>
                            <h5 class="card-title">{{ $data['names'] }}&nbsp;{{ $data['lastnames'] }}</h5>
                            <p class="card-text">
                                {{ $data['username'] }}
                                <br>
                                {{ $data['email'] }}
                            </p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
