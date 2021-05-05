@extends('layout.layout')

@section('title', 'Nuevo administrador')

@section('content')
	<header class="pb-3">
		<h3 class="text-center">Nuevo administrador</h3>
	</header>
	<div class="container-fluid">
		<form action="{{ route('newadmin') }}" method="POST">
			@csrf
			<div class="mb-3">
				<div class="row">
					<div class="col-4">
						<div class="">
							<label for="nombres_label">Nombres:</label>
							<input type="text" class="form-control" id="names" name="names" >
							@if ($errors->has('names'))
								<div class="d-block invalid-feedback">{{ $errors->first('names') }}</div>
							@endif
						</div>
					</div>
					<div class="col-4">
						<div class="">
							<label for="apellidos_label">Apellidos:</label>
							<input type="text" class="form-control" id="lastnames" name="lastnames" >
							@if ($errors->has('lastnames'))
								<div class="d-block invalid-feedback">{{ $errors->first('lastnames') }}</div>
							@endif
						</div>
					</div>
					<div class="col-4">
						<div class="">
							<label for="usuario_label">Nombre de usuario:</label>
							<input type="text" class="form-control" id="username" name="username" >
							@if ($errors->has('username'))
								<div class="d-block invalid-feedback">{{ $errors->first('username') }}</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class=" mb-3">
				<label for="email_label">Correo electronico:</label>
				<input type="email" class="form-control" id="email" name="email">
				@if ($errors->has('email'))
					<div class="d-block invalid-feedback">{{ $errors->first('email') }}</div>
				@endif	
			</div>
			<div class="mb-3">
				<div class="row">
					<div class="col-6">
						<div class="">
							<label for="password_label">Contraseña:</label>
							<input type="password" class="form-control" id="password" name="password">
							@if ($errors->has('password'))
								<div class="d-block invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
						</div>
					</div>
					<div class="col-6">
						<div class="">
							<label for="confirm_label">Confirmar contraseña:</label>
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-info" type="submit">Registrar</button>
		</form>
	</div>
@endsection

