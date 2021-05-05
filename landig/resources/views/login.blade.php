@extends('layout.layout')

@section('title', 'Login')

@section('content')
	<header class="pb-3">
		<h3 class="text-center">Login</h3>
	</header>
	@if (session('message'))
		<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
			<strong>{{ session('message') }}</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<br>
	@endif
	<div class="container-fluid">
		<div class="d-flex justify-content-center">
			<form action="{{ route('logged') }}" method="POST" style="width: 40% !important;">
				@csrf
				<div class="mb-3">
					<label for="label_email" class="form-label">Correo electronico:</label>
					<input type="email" class="form-control" id="email" name="email">
					@if ($errors->has('email'))
						<div class="d-block invalid-feedback">{{ $errors->first('email') }}</div>
					@endif
				</div>
				<div class="mb-3">
					<label for="label_contraseña" class="form-label">Contraseña:</label>
					<input type="password" class="form-control" id="password" name="password">
					@if ($errors->has('password'))
						<div class="d-block invalid-feedback">{{ $errors->first('password') }}</div>
					@endif
				</div>
				<br>
				<div class="d-grid gap-2">
					<button class="btn btn-info" type="submit">Iniciar sesión</button>
				</div>
			</form>
		</div>
	</div>
@endsection
