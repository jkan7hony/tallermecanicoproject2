@extends('layout.app')
@section('title', 'Detalle Vehículo')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="card entity-card">
					<div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
						<div>
							<h1 class="h4 mb-1 entity-title">Vehículo {{ $vehiculo->patente }}</h1>
							<div class="entity-subtitle small">Información general y relación con el cliente.</div>
						</div>
						<a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary rounded-pill">Volver</a>
					</div>
					<div class="card-body p-4 p-md-5">
						<div class="row g-4">
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Cliente</div><div>{{ $vehiculo->cliente?->nombre }} {{ $vehiculo->cliente?->apellido }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Patente</div><div><span class="badge badge-mechanic">{{ $vehiculo->patente }}</span></div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Marca</div><div>{{ $vehiculo->marca }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Modelo</div><div>{{ $vehiculo->modelo }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Año</div><div>{{ $vehiculo->anio }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Órdenes</div><div>{{ $vehiculo->ordenTrabajos?->count() ?? 0 }}</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
