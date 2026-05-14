@extends('layout.app')
@section('title', 'Editar Orden de Trabajo')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-9">
				<div class="text-center mb-4">
					<div class="bg-warning bg-opacity-10 d-inline-block p-2 rounded-circle mb-3">
						<i class="bi bi-pencil-square text-warning fs-3"></i>
					</div>
					<h2 class="entity-title">Editar Orden de Trabajo</h2>
					<p class="entity-subtitle mb-0">Actualiza el seguimiento de la orden.</p>
				</div>

				<div class="card entity-card">
					<div class="card-body p-4 p-md-5">
						<form action="{{ route('orden-trabajos.update', $ordenTrabajo) }}" method="POST" class="entity-form">
							@csrf
							@method('PUT')

							<div class="row g-3">
								<div class="col-12">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Vehículo</label>
									<select name="vehiculo_id" class="form-select @error('vehiculo_id') is-invalid @enderror">
										<option value="">Seleccionar vehículo</option>
										@foreach ($vehiculos as $vehiculo)
											<option value="{{ $vehiculo->id }}" @selected(old('vehiculo_id', $ordenTrabajo->vehiculo_id) == $vehiculo->id)>{{ $vehiculo->patente }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->cliente?->nombre }} {{ $vehiculo->cliente?->apellido }})</option>
										@endforeach
									</select>
									@error('vehiculo_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Fecha ingreso</label>
									<input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', $ordenTrabajo->fecha_ingreso) }}" class="form-control @error('fecha_ingreso') is-invalid @enderror">
									@error('fecha_ingreso') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Fecha salida</label>
									<input type="date" name="fecha_salida" value="{{ old('fecha_salida', $ordenTrabajo->fecha_salida) }}" class="form-control @error('fecha_salida') is-invalid @enderror">
									@error('fecha_salida') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Estado</label>
									@php($estados = ['Pendiente', 'En proceso', 'Finalizada', 'Cancelada'])
									<select name="estado" class="form-select @error('estado') is-invalid @enderror">
										<option value="">Seleccionar estado</option>
										@foreach ($estados as $estado)
											<option value="{{ $estado }}" @selected(old('estado', $ordenTrabajo->estado) === $estado)>{{ $estado }}</option>
										@endforeach
									</select>
									@error('estado') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-12">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Descripción del problema</label>
									<textarea name="descripcion_problema" rows="4" class="form-control @error('descripcion_problema') is-invalid @enderror">{{ old('descripcion_problema', $ordenTrabajo->descripcion_problema) }}</textarea>
									@error('descripcion_problema') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Costo estimado</label>
									<input type="number" min="0" step="1" name="costo_estimado" value="{{ old('costo_estimado', $ordenTrabajo->costo_estimado) }}" class="form-control @error('costo_estimado') is-invalid @enderror">
									@error('costo_estimado') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>
							</div>

							<div class="entity-actions d-flex flex-column flex-sm-row gap-3 justify-content-sm-between align-items-sm-center mt-4">
								<a href="{{ route('orden-trabajos.index') }}" class="btn btn-warning px-4 py-2 fw-bold rounded-pill">CANCELAR</a>
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
