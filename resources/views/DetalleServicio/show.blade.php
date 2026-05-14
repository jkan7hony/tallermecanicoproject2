@extends('layout.app')
@section('title', 'Detalle Servicio')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-9">
				<div class="card entity-card">
					<div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
						<div>
							<h1 class="h4 mb-1 entity-title">Detalle de Servicio</h1>
							<div class="entity-subtitle small">Relación entre orden, repuesto y descripción.</div>
						</div>
						<a href="{{ route('detalle-servicios.index') }}" class="btn btn-outline-secondary rounded-pill">Volver</a>
					</div>
					<div class="card-body p-4 p-md-5">
						<div class="row g-4">
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Orden</div><div>#{{ $detalleServicio->ordenTrabajo?->id }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Vehículo</div><div>{{ $detalleServicio->ordenTrabajo?->vehiculo?->patente }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Repuesto</div><div>{{ $detalleServicio->repuesto?->nombre }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Stock</div><div><span class="badge badge-mechanic">{{ $detalleServicio->stock }}</span></div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Nombre</div><div>{{ $detalleServicio->nombre }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Marca</div><div>{{ $detalleServicio->marca }}</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
