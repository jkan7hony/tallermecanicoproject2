@extends('layout.app')
@section('title', 'Inicio')

@section('content')
<div class="container py-4 py-lg-5">
    <div class="row align-items-center g-4 g-lg-5 mb-5">
        <div class="col-12 col-lg-7">
            <div class="p-4 p-lg-5 rounded-4" style="background: linear-gradient(145deg, rgba(31,35,42,0.98), rgba(23,26,32,0.94)); border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 20px 45px rgba(0,0,0,0.25);">
                <span class="badge badge-mechanic mb-3">Servicio mecánico integral</span>
                <h1 class="display-5 fw-bold mb-3">Cuidamos tu vehículo con diagnósticos claros y atención precisa.</h1>
                <p class="lead entity-subtitle mb-4">
                    Taller Mecánico centraliza clientes, vehículos, órdenes de trabajo, repuestos y detalles de servicio para dar un seguimiento ordenado a cada reparación.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">Ver clientes</a>
                    <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Gestionar vehículos</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card entity-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-gear-fill text-danger fs-4"></i>
                                </div>
                                <div>
                                    <h2 class="h5 mb-1">Diagnóstico organizado</h2>
                                    <div class="entity-muted small">Cada orden registra estado, fechas y costo estimado.</div>
                                </div>
                            </div>
                            <p class="mb-0 entity-subtitle">Seguimiento claro desde el ingreso del vehículo hasta la entrega final.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card entity-card h-100">
                        <div class="card-body p-4">
                            <h3 class="h6 text-uppercase entity-muted mb-3">Lo que gestionas</h3>
                            <ul class="list-unstyled mb-0 d-grid gap-2">
                                <li><i class="bi bi-check2-circle text-success me-2"></i>Clientes y RUT validados</li>
                                <li><i class="bi bi-check2-circle text-success me-2"></i>Vehículos por cliente</li>
                                <li><i class="bi bi-check2-circle text-success me-2"></i>Órdenes de trabajo</li>
                                <li><i class="bi bi-check2-circle text-success me-2"></i>Repuestos y stock</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card entity-card h-100">
                        <div class="card-body p-4">
                            <h3 class="h6 text-uppercase entity-muted mb-3">Flujo de trabajo</h3>
                            <div class="d-grid gap-2">
                                <div><span class="badge badge-mechanic me-2">1</span>Registras el cliente</div>
                                <div><span class="badge badge-mechanic me-2">2</span>Asocias su vehículo</div>
                                <div><span class="badge badge-mechanic me-2">3</span>Creas la orden</div>
                                <div><span class="badge badge-mechanic me-2">4</span>Asignas repuestos y servicio</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card entity-card h-100">
                <div class="card-body p-4">
                    <div class="entity-muted small text-uppercase fw-semibold mb-2">Clientes</div>
                    <h3 class="h5 mb-2">Base de datos ordenada</h3>
                    <p class="entity-subtitle mb-0">Guarda RUT, nombre, teléfono y correo con validaciones claras.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card entity-card h-100">
                <div class="card-body p-4">
                    <div class="entity-muted small text-uppercase fw-semibold mb-2">Vehículos</div>
                    <h3 class="h5 mb-2">Relación por cliente</h3>
                    <p class="entity-subtitle mb-0">Cada vehículo queda vinculado al propietario y a su historial.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card entity-card h-100">
                <div class="card-body p-4">
                    <div class="entity-muted small text-uppercase fw-semibold mb-2">Órdenes</div>
                    <h3 class="h5 mb-2">Seguimiento del servicio</h3>
                    <p class="entity-subtitle mb-0">Controla estados, fechas y costo estimado de cada intervención.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card entity-card h-100">
                <div class="card-body p-4">
                    <div class="entity-muted small text-uppercase fw-semibold mb-2">Repuestos</div>
                    <h3 class="h5 mb-2">Inventario disponible</h3>
                    <p class="entity-subtitle mb-0">Administra stock, precios y uso dentro de cada orden de trabajo.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
