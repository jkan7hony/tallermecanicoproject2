@extends('layout.app')
@section('title', 'Crear Repuesto')

@section('content')
<div class="entity-page py-4">
	<div class="entity-shell">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8 col-xl-7">
				<div class="text-center mb-4">
					<div class="bg-primary bg-opacity-10 d-inline-block p-2 rounded-circle mb-3">
						<i class="bi bi-tools text-primary fs-3"></i>
					</div>
					<h2 class="entity-title">Crear Repuesto</h2>
					<p class="entity-subtitle mb-0">Registra un repuesto para el inventario.</p>
				</div>

				<div class="card entity-card">
					<div class="card-body p-4 p-md-5">
						<form action="{{ route('repuestos.store') }}" method="POST" class="entity-form">
							@csrf

							<div class="row g-3">
								<div class="col-12">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Nombre</label>
									<input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Filtro de aceite">
									@error('nombre') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-12">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Descripción</label>
									<textarea name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Detalle opcional">{{ old('descripcion') }}</textarea>
									@error('descripcion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Precio</label>
									<input type="number" step="0.01" min="0" name="precio" value="{{ old('precio') }}" class="form-control @error('precio') is-invalid @enderror" placeholder="14990">
									@error('precio') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>

								<div class="col-md-6">
									<label class="form-label small text-uppercase entity-muted fw-semibold">Stock</label>
									<input type="number" min="0" max="99" name="stock" value="{{ old('stock') }}" class="form-control @error('stock') is-invalid @enderror" placeholder="10" inputmode="numeric" pattern="\d{1,2}" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,2)" onkeydown="if(event.key==='e'||event.key==='E')event.preventDefault();">
									@error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
								</div>
							</div>

							<div class="entity-actions d-flex flex-column flex-sm-row gap-3 justify-content-sm-between align-items-sm-center mt-4">
								<a href="{{ route('repuestos.index') }}" class="btn btn-warning px-4 py-2 fw-bold rounded-pill">CANCELAR</a>
								<button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded-pill">GUARDAR REPUESTO</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
