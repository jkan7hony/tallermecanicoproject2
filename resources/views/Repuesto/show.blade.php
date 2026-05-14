@extends('layout.app')
@section('title', 'Detalle Repuesto')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="card entity-card">
					<div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
						<div>
							<h1 class="h4 mb-1 entity-title">{{ $repuesto->nombre }}</h1>
							<div class="entity-subtitle small">Detalle del inventario.</div>
						</div>
						<a href="{{ route('repuestos.index') }}" class="btn btn-outline-secondary rounded-pill">Volver</a>
					</div>
					<div class="card-body p-4 p-md-5">
						<div class="row g-4">
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Precio</div><div>${{ number_format($repuesto->precio, 0, ',', '.') }}</div></div>
							<div class="col-md-6"><div class="entity-muted small text-uppercase fw-semibold mb-1">Stock</div><div><span class="badge badge-mechanic">{{ $repuesto->stock }}</span></div></div>
							<div class="col-12"><div class="entity-muted small text-uppercase fw-semibold mb-1">Descripción</div><div>{{ $repuesto->descripcion ?: 'Sin descripción' }}</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
