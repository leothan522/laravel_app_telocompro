<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>--}}

    <!-- Sidebar Menu -->
    @if (Auth::user()->role > 0)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            {{-- ********************* ***************************  SIDEBAR BOTONES *****************************--}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link lko-admin.dashboard lkm-admin.dashboard lk-admin.dashboard">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Escritorio
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            @if (leerJson(Auth::user()->permisos, 'e-commerce') || Auth::user()->role == 100)
            <li class="nav-item has-treeview lko-clientes.index lko-ajustes.index lko-horarios.index">
                <a href="#" class="nav-link lkm-clientes.index lkm-ajustes.index lkm-horarios.index">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        E-commerce
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link lk-">
                            <i class="fa fa-shopping-bag nav-icon"></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                </ul>
                @if (leerJson(Auth::user()->permisos, 'clientes.index') || Auth::user()->role == 100)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('clientes.index') }}" class="nav-link lk-clientes.index">
                            <i class="fa fa-child nav-icon"></i>
                            <p>Clientes</p>
                        </a>
                    </li>
                </ul>
                @endif
                @if (leerJson(Auth::user()->permisos, 'horarios.index') || Auth::user()->role == 100)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('horarios.index') }}" class="nav-link lk-horarios.index">
                            <i class="fa fa-clock nav-icon"></i>
                            <p>Store Hours</p>
                        </a>
                    </li>
                </ul>
                @endif
                @if (leerJson(Auth::user()->permisos, 'ajustes.index') || Auth::user()->role == 100)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('ajustes.index') }}" class="nav-link lk-ajustes.index">
                            <i class="fa fa-cog nav-icon"></i>
                            <p>Ajustes</p>
                        </a>
                    </li>
                </ul>
                @endif
            </li>
            @endif
            @if (leerJson(Auth::user()->permisos, 'productos') || Auth::user()->role == 100)
            <li class="nav-item has-treeview lko-categorias.index lko-productos.create lko-productos.index">
                <a href="#" class="nav-link lkm-categorias.index lkm-productos.create lkm-productos.index">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Productos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('productos.index') }}" class="nav-link lk-productos.index">
                            <i class="fa fa-cubes nav-icon"></i>
                            <p>Todos los productos</p>
                        </a>
                    </li>
                </ul>
                @if (leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 100)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('productos.create') }}" class="nav-link lk-productos.create">
                            <i class="fa fa-plus-circle nav-icon"></i>
                            <p>Añadir Nuevo</p>
                        </a>
                    </li>
                </ul>
                @endif
                @if (leerJson(Auth::user()->permisos, 'categorias.index') || Auth::user()->role == 100)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('categorias.index') }}" class="nav-link lk-categorias.index">
                            <i class="fa fa-tags nav-icon"></i>
                            <p>Categorias</p>
                        </a>
                    </li>
                </ul>
                @endif
            </li>
            @endif
            @if (leerJson(Auth::user()->permisos, 'configuracion') || Auth::user()->role == 100)
                <li class="nav-item has-treeview lko-usuarios.index{{--menu-open--}}">
                <a href="#" class="nav-link lkm-usuarios.index">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                        Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (leerJson(Auth::user()->permisos, 'usuarios.index') || Auth::user()->role == 100)
                    <li class="nav-item">
                        <a href="{{ route('usuarios.index') }}" class="nav-link lk-usuarios.index">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Todos los usuarios</p>
                        </a>
                    </li>
                    @endif
                    {{--<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inactive Page</p>
                        </a>
                    </li>--}}
                </ul>
            </li>
            @endif
        </ul>
        {{--<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Starter Pages
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Active Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inactive Page</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
        </ul>--}}
    </nav>
    @endif
    <!-- /.sidebar-menu -->
</div>
