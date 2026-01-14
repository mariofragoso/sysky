@extends('layouts.admin')

@section('titulo', 'Perfil de Usuario')

@section('contenido')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="badge bg-light text-primary p-2">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ $user->id === 1 ? 'Administrador' : 'Usuario' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('perfil.update') }}" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-4 text-center">
                                <div class="position-relative d-inline-block">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4e73df&color=ffffff&size=128" 
                                         class="rounded-circle border border-4 border-primary" 
                                         width="128" 
                                         alt="Avatar de {{ $user->name }}">

                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nombre completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>Guardar cambios
                                </button>
                                
                                <a href="{{ route('password.request') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-key me-2"></i>Cambiar contraseña
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection