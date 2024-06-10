   @extends('layouts.admin')

   @section('titulo', 'Lista de Empleados')

   @section('contenido')
       <div>
           <a href="{{ route('empleados.create') }}" class="btn btn-secondary">Crear Nuevo Empleado + </a>
       </div>
       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Número de Nómina</th>
                               <th>Nombre</th>
                               <th>Puesto</th>
                               <th>Área</th>
                               <th>Acciones</th>
                           </tr>
                       </thead>

                       <tbody>
                           @foreach ($empleados as $empleado)
                               <tr>
                                   <td>{{ $empleado->id }}</td>
                                   <td>{{ $empleado->numero_nomina }}</td>
                                   <td>{{ $empleado->nombre }}</td>
                                   <td>{{ $empleado->puesto }}</td>
                                   <td>{{ $empleado->area }}</td>
                                   <td>
                                       <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-primary">Ver</a>
                                       <a href="{{ route('empleados.edit', $empleado->id) }}"
                                           class="btn btn-warning">Editar</a>
                                       <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST"
                                           style="display:inline">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-danger">Eliminar</button>
                                       </form>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   @endsection
