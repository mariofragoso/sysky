@extends('layouts.app')

@section('content')
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="row g-0">
                        <!-- Imagen -->
                        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
                            <img src="{{ asset('libs/img/pngegg.png') }}" class="img-fluid" alt="Reset Password Image">
                        </div>
                        <!-- Formulario -->
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900">Restablecer Contraseña</h1>
                                    <p class="small text-muted">Introduce tu correo electrónico y la nueva contraseña</p>
                                </div>
                                <form method="POST" action="{{ route('password.update') }}" class="user">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Correo Electrónico" required autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Nueva Contraseña" required autocomplete="new-password">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user w-100">
                                        <i class="fas fa-sync-alt"></i> Restablecer Contraseña
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small text-muted" href="{{ route('login') }}">
                                        Ya tienes cuenta? Inicia sesión
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
@endsection
