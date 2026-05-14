@extends('layout.app')
@section('title', 'Clientes')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3" style="text-align: center;">Clientes</h1>
        </div>
        <a href="{{ route('clientes.create') }}" class="btn btn-outline-success rounded-pill">+ Nuevo cliente</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 px-4 py-3">
            <div>
                <h2 class="h6 mb-1 text-uppercase" style="text-align: center;">Tabla de clientes</h2>
                <div class="text-body-secondary small">RUT, contacto y acceso rápido a edición o eliminación.</div>
            </div>
            <div class="text-body-secondary small">{{ $clientes->count() }} cliente(s) registrados</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-container">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr class="border-top border-secondary-subtle">
                                <td class="fw-semibold">
                                    <span class="badge badge-mechanic">{{ $cliente->rut }}</span>
                                </td>
                                <td class="fw-semibold">{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->apellido }}</td>
                                <td>
                                    <span class="text-nowrap">{{ $cliente->telefono }}</span>
                                </td>
                                <td>
                                    <a href="mailto:{{ $cliente->email }}" class="text-decoration-none text-reset">{{ $cliente->email }}</a>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex flex-nowrap gap-2 align-items-center" style="justify-content: flex-end;">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-edit-custom rounded-pill">Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display: contents;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete-custom rounded-pill" onclick="return confirm('¿Eliminar cliente?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="mb-2">
                                        <span class="badge badge-mechanic">Vacío</span>
                                    </div>
                                    <div class="text-body-secondary">No hay clientes registrados.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection