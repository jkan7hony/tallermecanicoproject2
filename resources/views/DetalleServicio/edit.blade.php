@extends('layout.app')
@section('title', 'Editar Detalle de Servicio')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-9">
				<div class="text-center mb-4">
					<div class="bg-warning bg-opacity-10 d-inline-block p-2 rounded-circle mb-3">
						<i class="bi bi-pencil-square text-warning fs-3"></i>
					</div>
					<h2 class="entity-title">Editar Detalle de Servicio</h2>
					<p class="entity-subtitle mb-0">Actualiza la asociación del servicio.</p>
				</div>

				<div class="card entity-card">
					<div class="card-body p-4 p-md-5">
						<form action="{{ route('detalle-servicios.update', $detalleServicio) }}" method="POST" class="entity-form">
							@csrf
							@method('PUT')

							<div class="row g-3">
								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Orden de trabajo</label>
									<select name="orden_trabajo_id" class="form-select @error('orden_trabajo_id') is-invalid @enderror">
										<option value="">Seleccionar orden</option>
										@foreach ($ordenTrabajos as $ordenTrabajo)
											<option value="{{ $ordenTrabajo->id }}" @selected(old('orden_trabajo_id', $detalleServicio->orden_trabajo_id) == $ordenTrabajo->id)>#{{ $ordenTrabajo->id }} - {{ $ordenTrabajo->vehiculo?->patente }} - {{ $ordenTrabajo->vehiculo?->cliente?->nombre }} {{ $ordenTrabajo->vehiculo?->cliente?->apellido }}</option>
										@endforeach
									</select>
									@error('orden_trabajo_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Repuesto</label>
									<select name="repuesto_id" class="form-select @error('repuesto_id') is-invalid @enderror">
										<option value="">Seleccionar repuesto</option>
										@foreach ($repuestos as $repuesto)
											<option value="{{ $repuesto->id }}" @selected(old('repuesto_id', $detalleServicio->repuesto_id) == $repuesto->id)>{{ $repuesto->nombre }} - ${{ number_format($repuesto->precio, 0, ',', '.') }}</option>
										@endforeach
									</select>
									@error('repuesto_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Nombre</label>
									<input type="text" name="nombre" value="{{ old('nombre', $detalleServicio->nombre) }}" class="form-control @error('nombre') is-invalid @enderror">
									@error('nombre') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Marca</label>
									<input type="text" name="marca" value="{{ old('marca', $detalleServicio->marca) }}" class="form-control @error('marca') is-invalid @enderror">
									@error('marca') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-4">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Stock</label>
									<input type="number" min="0" max="99" name="stock" value="{{ old('stock', $detalleServicio->stock) }}" class="form-control @error('stock') is-invalid @enderror" inputmode="numeric" pattern="\d{1,2}" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,2)" onkeydown="if(event.key==='e'||event.key==='E')event.preventDefault();">
									@error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>
							</div>

							<div class="entity-actions d-flex flex-column flex-sm-row gap-3 justify-content-sm-between align-items-sm-center mt-4">
								<a href="{{ route('detalle-servicios.index') }}" class="btn btn-warning px-4 py-2 fw-bold rounded-pill">CANCELAR</a>
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
