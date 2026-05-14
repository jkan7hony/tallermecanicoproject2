@extends('layout.app')
@section('title', 'Editar Vehículo')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-9 col-xl-8">
				<div class="text-center mb-4">
					<div class="bg-warning bg-opacity-10 d-inline-block p-2 rounded-circle mb-3">
						<i class="bi bi-pencil-square text-warning fs-3"></i>
					</div>
					<h2 class="entity-title">Editar Vehículo</h2>
					<p class="entity-subtitle mb-0">Actualiza los datos del vehículo {{ $vehiculo->patente }}.</p>
				</div>

				<div class="card entity-card">
					<div class="card-body p-4 p-md-5">
						<form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" class="entity-form">
							@csrf
							@method('PUT')

							<div class="row g-3">
								<div class="col-12">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Cliente</label>
									<select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
										<option value="">Seleccionar cliente</option>
										@foreach ($clientes as $cliente)
											<option value="{{ $cliente->id }}" @selected(old('cliente_id', $vehiculo->cliente_id) == $cliente->id)>{{ $cliente->rut }} - {{ $cliente->nombre }} {{ $cliente->apellido }}</option>
										@endforeach
									</select>
									@error('cliente_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Patente</label>
									<input type="text" name="patente" value="{{ old('patente', $vehiculo->patente) }}" class="form-control @error('patente') is-invalid @enderror" placeholder="ABC123" inputmode="numeric" pattern="\d{6}" maxlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,6)">
									@error('patente') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Año</label>
									<input type="number" name="anio" value="{{ old('anio', $vehiculo->anio) }}" class="form-control @error('anio') is-invalid @enderror" min="1900" max="{{ date('Y') }}">
									@error('anio') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Marca</label>
									<input type="text" name="marca" value="{{ old('marca', $vehiculo->marca) }}" class="form-control @error('marca') is-invalid @enderror">
									@error('marca') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Modelo</label>
									<input type="text" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" class="form-control @error('modelo') is-invalid @enderror">
									@error('modelo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>
							</div>

							<div class="entity-actions d-flex flex-column flex-sm-row gap-3 justify-content-sm-between align-items-sm-center mt-4">
								<a href="{{ route('vehiculos.index') }}" class="btn btn-warning px-4 py-2 fw-bold rounded-pill">CANCELAR</a>
								<button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded-pill">GUARDAR CAMBIOS</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
