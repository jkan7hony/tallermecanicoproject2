@extends('layout.app')
@section('title', 'Vehículos')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
			<div>
				<h1 class="entity-title h3 mb-1">Vehículos</h1>
				<p class="entity-subtitle mb-0">Registro de vehículos asociados a cada cliente.</p>
			</div>
			<a href="{{ route('vehiculos.create') }}" class="btn btn-outline-success rounded-pill">+ Nuevo vehículo</a>
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
					<h2 class="h6 mb-1 text-uppercase">Tabla de vehículos</h2>
					<div class="entity-muted small">Patente, cliente y datos básicos del vehículo.</div>
				</div>
				<div class="entity-muted small">{{ $vehiculos->count() }} vehículo(s) registrados</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive table-container">
					<table class="table table-hover align-middle mb-0">
						<thead>
							<tr>
								<th>Patente</th>
								<th>Cliente</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Año</th>
								<th class="text-end">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($vehiculos as $vehiculo)
								<tr class="border-top border-secondary-subtle">
									<td class="fw-semibold"><span class="badge badge-mechanic">{{ $vehiculo->patente }}</span></td>
									<td>{{ $vehiculo->cliente?->nombre }} {{ $vehiculo->cliente?->apellido }}</td>
									<td>{{ $vehiculo->marca }}</td>
									<td>{{ $vehiculo->modelo }}</td>
									<td>{{ $vehiculo->anio }}</td>
									<td class="text-end">
										<div class="d-flex flex-nowrap gap-2 justify-content-end">
											<a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-outline-secondary rounded-pill">Ver</a>
											<a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-edit-custom rounded-pill">Editar</a>
											<form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" style="display: contents;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-delete-custom rounded-pill" onclick="return confirm('¿Eliminar vehículo?')">Eliminar</button>
											</form>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="6" class="text-center py-5">
										<div class="mb-2"><span class="badge badge-mechanic">Vacío</span></div>
										<div class="entity-muted">No hay vehículos registrados.</div>
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
