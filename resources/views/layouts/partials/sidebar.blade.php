<style>
    /* Sidebar Background Gradient */
    #accordionSidebar {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        /* Tonos oscuros y elegantes */
        color: #ffffff;
    }

    /* Brand Style */
    .sidebar-brand {
        background-color: #1c2833;
        /* Azul oscuro sólido para el fondo del logo */
        padding: 15px;
        border-radius: 8px;
        margin: 10px;
        color: #ffcc00;
        /* Acento en dorado */
        font-weight: bold;
    }

    .sidebar-brand:hover {
        background-color: #283747;
        /* Color más claro al pasar el mouse */
    }

    /* Divider Styling */
    .sidebar-divider {
        border-color: rgba(255, 255, 255, 0.2);
        /* Línea divisoria más sutil */
    }

    /* Sidebar Links */
    .nav-item .nav-link {
        color: #ffffff;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
    }

    .nav-item .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding-left: 15px;
        color: #ffcc00;
        /* Cambio a dorado al pasar el mouse */
    }

    .nav-item.active .nav-link {
        color: #ffcc00;
        /* Dorado para los enlaces activos */
        font-weight: bold;
    }

    /* Icons Styling */
    .nav-link i {
        font-size: 1.1em;
        margin-right: 8px;
        color: #b8c0c7;
        /* Tonalidad gris claro para iconos */
        transition: transform 0.3s ease-in-out;
    }

    .nav-link:hover i {
        transform: scale(1.2);
        color: #ffcc00;
        /* Dorado para los iconos al pasar el mouse */
    }

    /* Section Headings */
    .sidebar-heading {
        font-size: 1em;
        color: #dcdcdc;
        /* Blanco suave para encabezados */
        text-transform: uppercase;
        font-weight: 600;
        padding-top: 10px;
    }

    /* Collapse Item Background */
    .collapse-item {
        color: #ffffff;
        font-weight: 500;
    }

    .collapse-item:hover {
        background-color: rgba(255, 255, 255, 0.15);
        /* Fondo suave al pasar el mouse */
        border-radius: 5px;
        color: #ffcc00;
        /* Dorado al pasar el mouse */
    }

    /* Sidebar Toggler */
    #sidebarToggle {
        color: #ffffff;
    }

    .sidebar .nav-item.active {
        color: #17a673;
        background-color: #577be7;
    }
</style>


<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sis <sup>Infra</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Inventario</div>

    <!-- Nav Items -->
    <li class="nav-item {{ Request::routeIs('empleados.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('empleados.index') }}">
            <i class="fas fa-users"></i>
            <span>Empleados</span>
        </a>
    </li>

    <li class="nav-item {{ Request::routeIs('equipos.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('equipos.index') }}">
            <i class="fas fa-keyboard"></i>
            <span>Equipos</span>
        </a>
    </li>
    
    <li class="nav-item {{ Request::routeIs('accesorios.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('accesorios.index') }}">
            <i class="fas fa-keyboard"></i>
            <span>Accesorios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Acciones
    </div>

    <!-- Nav Items -->
    <li class="nav-item {{ Request::routeIs('asignacionesequipos.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('asignacionesequipos.index') }}">
            <i class="fas fa-laptop"></i>
            <span>Asignacion de Equipo</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('asignacionaccesorios.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('asignacionaccesorios.index') }}">
            <i class="fas fa-mouse"></i>
            <span>Asignacion de Accesorios</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('prestamos.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('prestamos.index') }}">
            <i class="fas fa-hand-holding"></i>
            <span>Prestamos</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('salidas.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('salidas.index') }}">
            <i class="fas fa-laptop-house"></i>
            <span>Salida de equipo</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Otro
    </div>
    <li class="nav-item {{ Request::routeIs('impresoras.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('impresoras.index') }}">
            <i class="fas fa-print"></i>
            <span>Test Impresoras</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Adicional
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-plus"></i>
            <span>Agregar</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('empresas.index') }}">Empresas</a>
                <a class="collapse-item" href="{{ route('tiposequipos.index') }}">Tipo de Equipo</a>
                <a class="collapse-item" href="{{ route('marcas.index') }}">Marca de Equipo</a>
                <a class="collapse-item" href="{{ route('marcasaccesorios.index') }}">Marca de Accesorio</a>
            </div>
        </div>
    </li>
    @if (in_array(auth()->id(), [1]))
        <div class="sidebar-heading">
            Ajustes
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                aria-expanded="true" aria-controls="collapsePages1">
                <i class="fas fa-cog"></i>
                <span>Configuraciones</span>
            </a>

            <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('acciones.index') }}">Acciones</a>
                    <a class="collapse-item" href="{{ route('backups.index') }}">Backup</a>
                    <a class="collapse-item" href="{{ route('register') }}">Registrar Usuario</a>
                </div>
            </div>

        </li>
    @endif




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Other nav items continue... -->
</ul>
