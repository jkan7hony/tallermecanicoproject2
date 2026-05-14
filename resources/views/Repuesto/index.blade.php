@extends('layout.app')
@section('title', 'Repuestos')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
			<div>
				<h1 class="entity-title h3 mb-1">Repuestos</h1>
				<p class="entity-subtitle mb-0">Inventario de repuestos y precios.</p>
			</div>
			<a href="{{ route('repuestos.create') }}" class="btn btn-outline-success rounded-pill">+ Nuevo repuesto</a>
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
					<h2 class="h6 mb-1 text-uppercase">Tabla de repuestos</h2>
					<div class="entity-muted small">Nombre, precio y stock disponible.</div>
				</div>
				<div class="entity-muted small">{{ $repuestos->count() }} repuesto(s) registrados</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive table-container">
					<table class="table table-hover align-middle mb-0">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Precio</th>
								<th>Stock</th>
								<th class="text-end">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($repuestos as $repuesto)
								<tr class="border-top border-secondary-subtle">
									<td class="fw-semibold">{{ $repuesto->nombre }}</td>
									<td>{{ $repuesto->descripcion ?: 'Sin descripción' }}</td>
									<td>${{ number_format($repuesto->precio, 0, ',', '.') }}</td>
									<td><span class="badge badge-mechanic">{{ $repuesto->stock }}</span></td>
									<td class="text-end">
										<div class="d-flex flex-nowrap gap-2 justify-content-end">
											<a href="{{ route('repuestos.show', $repuesto) }}" class="btn btn-outline-secondary rounded-pill">Ver</a>
											<a href="{{ route('repuestos.edit', $repuesto) }}" class="btn btn-edit-custom rounded-pill">Editar</a>
											<form action="{{ route('repuestos.destroy', $repuesto) }}" method="POST" style="display: contents;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-delete-custom rounded-pill" onclick="return confirm('¿Eliminar repuesto?')">Eliminar</button>
											</form>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center py-5">
										<div class="mb-2"><span class="badge badge-mechanic">Vacío</span></div>
										<div class="entity-muted">No hay repuestos registrados.</div>
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
