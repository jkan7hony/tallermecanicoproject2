@extends('layout.app')
@section('title', 'Órdenes de Trabajo')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
			<div>
				<h1 class="entity-title h3 mb-1">Órdenes de Trabajo</h1>
				<p class="entity-subtitle mb-0">Seguimiento de ingresos, estado y costo estimado.</p>
			</div>
			<a href="{{ route('orden-trabajos.create') }}" class="btn btn-outline-success rounded-pill">+ Nueva orden</a>
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
					<h2 class="h6 mb-1 text-uppercase">Tabla de órdenes</h2>
					<div class="entity-muted small">Vehículo, cliente, estado y fechas.</div>
				</div>
				<div class="entity-muted small">{{ $ordenTrabajos->count() }} orden(es) registradas</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive table-container">
					<table class="table table-hover align-middle mb-0">
						<thead>
							<tr>
								<th>Vehículo</th>
								<th>Cliente</th>
								<th>Ingreso</th>
								<th>Salida</th>
								<th>Estado</th>
								<th>Costo</th>
								<th class="text-end">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($ordenTrabajos as $ordenTrabajo)
								<tr class="border-top border-secondary-subtle">
									<td><span class="badge badge-mechanic">{{ $ordenTrabajo->vehiculo?->patente }}</span></td>
									<td>{{ $ordenTrabajo->vehiculo?->cliente?->nombre }} {{ $ordenTrabajo->vehiculo?->cliente?->apellido }}</td>
									<td>{{ $ordenTrabajo->fecha_ingreso }}</td>
									<td>{{ $ordenTrabajo->fecha_salida ?: 'Pendiente' }}</td>
									<td>{{ $ordenTrabajo->estado }}</td>
									<td>${{ number_format($ordenTrabajo->costo_estimado, 0, ',', '.') }}</td>
									<td class="text-end">
										<div class="d-flex flex-nowrap gap-2 justify-content-end">
											<a href="{{ route('orden-trabajos.show', $ordenTrabajo) }}" class="btn btn-outline-secondary rounded-pill">Ver</a>
											<a href="{{ route('orden-trabajos.edit', $ordenTrabajo) }}" class="btn btn-edit-custom rounded-pill">Editar</a>
											<form action="{{ route('orden-trabajos.destroy', $ordenTrabajo) }}" method="POST" style="display: contents;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-delete-custom rounded-pill" onclick="return confirm('¿Eliminar orden de trabajo?')">Eliminar</button>
											</form>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="7" class="text-center py-5">
										<div class="mb-2"><span class="badge badge-mechanic">Vacío</span></div>
										<div class="entity-muted">No hay órdenes de trabajo registradas.</div>
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
