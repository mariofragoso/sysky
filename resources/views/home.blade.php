@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')

    <div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card-counter info">
                    <i class="fas fa-user"></i>
                    <span class="count-numbers">{{ $empleados_count }}</span>
                    <span class="count-name">Empleados Registrados</span>
                    <div class="info-footer">
                        <a href="{{ route('empleados.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter danger">
                    <i class="fas fa-desktop"></i>
                    <span class="count-numbers">{{ $equipos_count }}</span>
                    <span class="count-name">Equipos</span>
                    <div class="info-footer">
                        <a href="{{ route('equipos.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter success">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $accesorios_count }}</span>
                    <span class="count-name">Accesorios</span>
                    <div class="info-footer">
                        <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter primary">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $equiposNoAsignados }}</span>
                    <span class="count-name">Equipos no asignados</span>
                    <div class="info-footer">
                        <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <!-- Gráfica -->

        </div>
    </div>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <div class="col-lg-6">
                <div class="chart-container" style="position: relative; height:85vh; width:80vw">
                    <canvas id="equiposChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection
<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('equiposChart').getContext('2d');
            var equiposChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Asignados', 'No Asignados', 'Bajas'],
                    datasets: [{
                        label: 'Número de Equipos {{ $equipos_count }}',
                        data: [{{ $equiposAsignados }}, {{ $equiposNoAsignados }},
                            {{ $equiposBaja }}
                        ],
                        backgroundColor: [
                            'rgba(26, 188, 156, 1)',
                            'rgba(255, 195, 0, 1)',
                            'rgba(255, 87, 51, 1)'
                        ],
                        borderColor: [
                            'rgba(26, 188, 156, 1)',
                            'rgba(255, 195, 0, 1)',
                            'rgba(255, 87, 51, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
