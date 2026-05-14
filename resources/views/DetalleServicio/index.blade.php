@extends('layout.app')
@section('title', 'Detalles de Servicio')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
			<div>
				<h1 class="entity-title h3 mb-1">Detalles de Servicio</h1>
				<p class="entity-subtitle mb-0">Relación entre órdenes de trabajo y repuestos utilizados.</p>
			</div>
			<a href="{{ route('detalle-servicios.create') }}" class="btn btn-outline-success rounded-pill">+ Nuevo detalle</a>
		</div>

		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
			</div>
		@endif

		<div class="card entity-card entity-index-card">
			<div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 px-4 py-3">
				<div>
					<h2 class="h6 mb-1 text-uppercase">Tabla de detalles</h2>
					<div class="entity-muted small">Orden, repuesto y cantidad asociada.</div>
				</div>
				<div class="entity-muted small">{{ $detalleServicios->count() }} detalle(s) registrados</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive table-container">
					<table class="table table-hover align-middle mb-0">
						<thead>
							<tr>
								<th>Orden</th>
								<th>Vehículo</th>
								<th>Repuesto</th>
								<th>Nombre</th>
								<th>Marca</th>
								<th>Stock</th>
								<th class="text-end">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($detalleServicios as $detalleServicio)
								<tr class="border-top border-secondary-subtle">
									<td>{{ $detalleServicio->ordenTrabajo?->id }}</td>
									<td>{{ $detalleServicio->ordenTrabajo?->vehiculo?->patente }}</td>
									<td>{{ $detalleServicio->repuesto?->nombre }}</td>
									<td>{{ $detalleServicio->nombre }}</td>
									<td>{{ $detalleServicio->marca }}</td>
									<td><span class="badge badge-mechanic">{{ $detalleServicio->stock }}</span></td>
									<td class="text-end">
										<div class="d-flex flex-nowrap gap-2 justify-content-end">
											<a href="{{ route('detalle-servicios.show', $detalleServicio) }}" class="btn btn-outline-secondary rounded-pill">Ver</a>
											<a href="{{ route('detalle-servicios.edit', $detalleServicio) }}" class="btn btn-edit-custom rounded-pill">Editar</a>
											<form action="{{ route('detalle-servicios.destroy', $detalleServicio) }}" method="POST" style="display: contents;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-delete-custom rounded-pill" onclick="return confirm('¿Eliminar detalle de servicio?')">Eliminar</button>
											</form>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="7" class="text-center py-5">
										<div class="mb-2"><span class="badge badge-mechanic">Vacío</span></div>
										<div class="entity-muted">No hay detalles de servicio registrados.</div>
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
