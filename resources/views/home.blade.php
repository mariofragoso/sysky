@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')
<<<<<<< Updated upstream
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $empleados_count }}</h3>
                    <p>Empleados Registrados</p>
=======
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $empleados_count }}</h3>
                        <p>Empleados Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ route('empleados.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
>>>>>>> Stashed changes
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $equipos_count }}</h3>
                        <p>Equipos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <a href="{{ route('equipos.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $accesorios_count }}</h3>
                        <p>Accesorios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
<<<<<<< Updated upstream


        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>150</h3>
    
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
        <!-- ./col -->

=======
        <!-- /.row -->
>>>>>>> Stashed changes
    </div>
@endsection
