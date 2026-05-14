@extends('layout.app')
@section('title', 'Detalle Orden de Trabajo')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-9">
				<div class="card entity-card">
					<div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
						<div>
							<h1 class="h4 mb-1 entity-title">Orden de Trabajo</h1>
							<div class="entity-subtitle small">Seguimiento completo del trabajo.</div>
						</div>
						<a href="{{ route('orden-trabajos.index') }}" class="btn btn-outline-secondary rounded-pill">Volver</a>
					</div>
					<div class="card-body p-4 p-md-5">
						<div class="row g-4">
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Vehículo</div><div>{{ $ordenTrabajo->vehiculo?->patente }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Cliente</div><div>{{ $ordenTrabajo->vehiculo?->cliente?->nombre }} {{ $ordenTrabajo->vehiculo?->cliente?->apellido }}</div></div>
							<div class="col-md-4"><div class="entity-muted small text-uppercase fw-semibold mb-1">Ingreso</div><div>{{ $ordenTrabajo->fecha_ingreso }}</div></div>
							<div class="col-md-4"><div class="entity-muted small text-uppercase fw-semibold mb-1">Salida</div><div>{{ $ordenTrabajo->fecha_salida ?: 'Pendiente' }}</div></div>
							<div class="col-md-4"><div class="entity-muted small text-uppercase fw-semibold mb-1">Estado</div><div><span class="badge badge-mechanic">{{ $ordenTrabajo->estado }}</span></div></div>
							<div class="col-12"><div class="entity-muted small text-uppercase fw-semibold mb-1">Descripción</div><div>{{ $ordenTrabajo->descripcion_problema }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Costo estimado</div><div>${{ number_format($ordenTrabajo->costo_estimado, 0, ',', '.') }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Detalles de servicio</div><div>{{ $ordenTrabajo->detalleServicios?->count() ?? 0 }}</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
