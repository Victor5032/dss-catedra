@extends('layout.layout')

@section('title', 'Inventario')

@section('content')
    <header class="pb-3">
        <h3 class="text-center">
            @if (Route::currentRouteName() == 'agregar')
                Agregar pelicula
            @endif
            @if (Route::currentRouteName() == 'editar')
                Editar pelicula
            @endif
        </h3>
    </header>
    <br>
    <div class="container-fluid">
		<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
			@csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="title_label">Titulo:</label>
                        <input class="form-control" type="text" id="title" name="title" value="@isset($data->title){{ $data->title }}@endisset">
                        @if ($errors->has('title'))
                            <div class="d-block invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="col-6">
                        <label for="poster_label">Poster:</label>
                        <input class="form-control" type="text" id="poster" name="poster" value="@isset($data->poster){{ $data->poster }}@endisset">
                        @if ($errors->has('poster'))
                            <div class="d-block invalid-feedback">{{ $errors->first('poster') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description_label">Descripción:</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control textarea-form">@isset($data->description){{ $data->description }}@endisset</textarea>
                @if ($errors->has('description'))
                    <div class="d-block invalid-feedback">{{ $errors->first('description') }}</div>
                @endif
            </div>
			<div class="mb-3">
				<div class="row">
					<div class="col-4">
						<div class="">
							<label for="rent_label">Precio de alquiler ($):</label>
							<input type="text" class="form-control" id="rent_price" name="rent_price" value="@isset($data->rent_price){{ $data->rent_price }}@endisset">
							@if ($errors->has('rent_price'))
								<div class="d-block invalid-feedback">{{ $errors->first('rent_price') }}</div>
							@endif
						</div>
					</div>
					<div class="col-4">
						<div class="">
							<label for="sale_label">Precio de venta ($):</label>
							<input type="text" class="form-control" id="sale_price" name="sale_price" value="@isset($data->sale_price){{ $data->sale_price }}@endisset">
							@if ($errors->has('sale_price'))
								<div class="d-block invalid-feedback">{{ $errors->first('sale_price') }}</div>
							@endif
						</div>
					</div>
					<div class="col-4">
						<div class="">
							<label for="stock_label">Unidades:</label>
							<input type="text" class="form-control" id="stock" name="stock" value="@isset($data->stock){{ $data->stock }}@endisset">
							@if ($errors->has('stock'))
								<div class="d-block invalid-feedback">{{ $errors->first('stock') }}</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-info" type="submit">Agregar</button>
		</form>
	</div>
@endsection
