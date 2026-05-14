@extends('layout.app')
@section('title', 'Crear Cliente')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-lg-8 col-xl-7">
            
            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 d-inline-block p-2 rounded-circle mb-3">
                    <i class="bi bi-person-plus-fill text-primary fs-3"></i>
                </div>
                <h2 class="fw-bold text-white">Crear Nuevo Cliente</h2>
                <p class="text-secondary">Ingrese los datos para el registro oficial</p>
            </div>

            <div class="card border-0 shadow-lg bg-dark text-white" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <p class="text-primary small fw-bold text-uppercase mb-4 text-center" style="letter-spacing: 2px;">
                                <i class="bi bi-info-circle me-2"></i>Información de Identidad
                            </p>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small text-secondary fw-semibold">RUT / Identificador</label>
                                    <div class="input-group custom-group">
                                        <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-card-text"></i></span>
                                             <input type="text" name="rut" value="{{ old('rut') }}" maxlength="12" pattern="(?:[0-9]{7,8}|[0-9]{1,2}(?:\.[0-9]{3}){2})-[0-9Kk]" title="Formato válido: 12.345.678-5 o 12345678-5" 
                                               class="form-control bg-transparent text-white border-secondary @error('rut') is-invalid @enderror" 
                                               placeholder="12.345.678-9">
                                    </div>
                                    @error('rut') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-secondary fw-semibold">Nombre(s)</label>
                                    <div class="input-group custom-group">
                                        <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}" 
                                               class="form-control bg-transparent text-white border-secondary @error('nombre') is-invalid @enderror" 
                                               placeholder="Juan Pablo">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-secondary fw-semibold">Apellidos</label>
                                    <div class="input-group custom-group">
                                        <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" name="apellido" value="{{ old('apellido') }}" 
                                               class="form-control bg-transparent text-white border-secondary @error('apellido') is-invalid @enderror" 
                                               placeholder="Pérez Rossi">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-info small fw-bold text-uppercase mb-4 text-center" style="letter-spacing: 2px;">
                                <i class="bi bi-telephone me-2"></i>Medios de Contacto
                            </p>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-secondary fw-semibold">Teléfono</label>
                                    <div class="input-group custom-group">
                                        <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-whatsapp"></i></span>
                                        <input type="text" name="telefono" value="{{ old('telefono') }}" maxlength="9" inputmode="numeric" pattern="[0-9]{1,9}" 
                                               class="form-control bg-transparent text-white border-secondary @error('telefono') is-invalid @enderror" 
                                               placeholder="123456789">
                                    </div>
                                    @error('telefono') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-secondary fw-semibold">Email</label>
                                    <div class="input-group custom-group">
                                        <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" value="{{ old('email') }}" 
                                               class="form-control bg-transparent text-white border-secondary @error('email') is-invalid @enderror" 
                                               placeholder="ejemplo@correo.com">
                                    </div>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-6 pt-6 border-top border-secondary border-opacity-25">
                            <div class="d-grid gap-4 d-sm-flex justify-content-sm-center">
                                <a href="{{ route('clientes.index') }}" class="btn btn-warning px-4 py-2 fw-bold me-sm-2 rounded-pill">
                                    CANCELAR
                                </a>
                                <button type="submit" class="btn btn-success px-5 py-2 fw-bold shadow rounded-pill">
                                    ✓ GUARDAR CLIENTE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-group .input-group-text {
        width: 45px; 
        justify-content: center;
        border-right: none;
    }
    
    .custom-group .form-control {
        border-left: none;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: white;
        box-shadow: none;
        border-color: #0d6efd;
    }

    .custom-group .form-control.is-invalid {
        border-color: #dc3545 !important;
    }

    .custom-group .form-control.is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    body {
        background-color: #0f1113; 
    }

    .btn-success {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        color: white !important;
    }

    .btn-success:hover {
        background-color: #218838 !important;
        border-color: #1e7e34 !important;
    }

    .btn-success:active,
    .btn-success:focus {
        background-color: #1e7e34 !important;
        border-color: #1c7430 !important;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.5) !important;
    }

    .btn-warning {
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
        color: #000 !important;
    }

    .btn-warning:hover {
        background-color: #e0a800 !important;
        border-color: #d39e00 !important;
        color: #000 !important;
    }

    .btn-warning:active,
    .btn-warning:focus {
        background-color: #d39e00 !important;
        border-color: #c69500 !important;
        color: #000 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.5) !important;
    }

    .btn + .btn {
        margin-left: 1.5rem;
    }

    .text-center.mt-6 {
        margin-top: 1.5rem !important;
        padding-top: 1rem !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nombreInput = document.querySelector('input[name="nombre"]');
        if (nombreInput) {
            nombreInput.addEventListener('input', function(e) {
                const value = e.target.value;
                const newValue = value.replace(/[^a-záéíóúàèìòùäëïöüñ\s]/gi, '');
                if (value !== newValue) {
                    e.target.value = newValue;
                    showToast('El nombre solo puede contener letras', 'warning');
                }
            });
        }

        const apellidoInput = document.querySelector('input[name="apellido"]');
        if (apellidoInput) {
            apellidoInput.addEventListener('input', function(e) {
                const value = e.target.value;
                const newValue = value.replace(/[^a-záéíóúàèìòùäëïöüñ\s]/gi, '');
                if (value !== newValue) {
                    e.target.value = newValue;
                    showToast('El apellido solo puede contener letras', 'warning');
                }
            });
        }

        const telefonoInput = document.querySelector('input[name="telefono"]');
        if (telefonoInput) {
            telefonoInput.addEventListener('input', function(e) {
                const value = e.target.value;
                const newValue = value.replace(/\D/g, '').slice(0, 9);
                if (value !== newValue) {
                    e.target.value = newValue;
                    showToast('El teléfono solo puede contener hasta 9 dígitos', 'warning');
                }
            });
        }

        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const rutInput = document.querySelector('input[name="rut"]');
                const nombreInput = document.querySelector('input[name="nombre"]');
                const apellidoInput = document.querySelector('input[name="apellido"]');
                const telefonoInput = document.querySelector('input[name="telefono"]');
                const emailInput = document.querySelector('input[name="email"]');

                // Validaciones básicas
                if (!rutInput.value.trim()) {
                    e.preventDefault();
                    showToast('El RUT es requerido', 'danger');
                    rutInput.focus();
                    return;
                }
                if (!nombreInput.value.trim()) {
                    e.preventDefault();
                    showToast('El nombre es requerido', 'danger');
                    nombreInput.focus();
                    return;
                }
                if (!apellidoInput.value.trim()) {
                    e.preventDefault();
                    showToast('El apellido es requerido', 'danger');
                    apellidoInput.focus();
                    return;
                }
                if (!telefonoInput.value.trim()) {
                    e.preventDefault();
                    showToast('El teléfono es requerido', 'danger');
                    telefonoInput.focus();
                    return;
                }
                if (!emailInput.value.trim()) {
                    e.preventDefault();
                    showToast('El email es requerido', 'danger');
                    emailInput.focus();
                    return;
                }
            });
        }
    });

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);';
        toast.setAttribute('role', 'alert');
        
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 4000);
    }
</script>
@endsection