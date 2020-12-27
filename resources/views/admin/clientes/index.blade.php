@extends('layouts.admin.master')

@section('title', 'Clientes')

@section('header', 'Clientes')

@section('breadcrumb')
    <li class="breadcrumb-item active">Clientes Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    <script>
        jQuery(function ($) {
            $('.table').footable();
        });
    </script>
@endsection

@section('nav-buscar')
    {!! Form::open(['route' => 'clientes.index', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
        <input type="search" name="buscar" class="form-control form-control-navbar"  placeholder="Buscar Cedula" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Clientes Registrados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-child"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <ol class="breadcrumb">
                            @if (isset($_GET['buscar']))
                                <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Todos <span class="text-muted">({{ cerosIzquierda($todos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Todos ({{ cerosIzquierda($todos) }})</li>
                            @endif

                            {{--@if ($role != 100 || isset($_GET['buscar']))
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Todos <span class="text-muted">({{ cerosIzquierda($todos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Todos ({{ cerosIzquierda($todos) }})</li>
                            @endif
                            @if ($role != 1)
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.role', 1) }}">Administrador <span class="text-muted">({{ cerosIzquierda($administrador) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Administrador <span class="text-muted">({{ cerosIzquierda($administrador) }})</span></li>
                            @endif
                            @if ($role != 2)
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.role', 2) }}">Gestor de Tienda <span class="text-muted">({{ cerosIzquierda($gestor) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Gestor de Tienda <span class="text-muted">({{ cerosIzquierda($gestor) }})</span></li>
                            @endif
                            @if ($role != 0)
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.role', 0) }}">Clientes <span class="text-muted">({{ cerosIzquierda($cliente) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Clientes <span class="text-muted">({{ cerosIzquierda($cliente) }})</span></li>
                            @endif--}}
                        </ol>

                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                <th scope="col" class="text-center">Cedula</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col" data-breakpoints="xs">Teléfono</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Pedidos</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Gasto Total</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Ultima Compra</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Username</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Email</th>
                                <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <th scope="row" class="text-center">{{ $cliente->id }}</th>
                                    <td>{{ formatoMillares($cliente->cedula, 0) }}</td>
                                    <td>{{ ucwords($cliente->nombre) }} {{ ucwords($cliente->apellidos) }}</td>
                                    <td>{{ strtoupper($cliente->telefono) }}</td>
                                    <td class="text-center">{{ formatoMillares($cliente->num_pedidos, 0) }}</td>
                                    <td class="text-center">{{ formatoMillares($cliente->gasto_dolar) }}</td>
                                    <td class="text-center">{{ haceCuanto($cliente->ultima_compra) }}</td>
                                    <td>{{ ucwords($cliente->usuario->name) }}</td>
                                    <td>{{ $cliente->usuario->email }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'clientes.show') || Auth::user()->role == 100)
                                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            @endif
                                            {{--@if (leerJson(Auth::user()->permisos, 'usuarios.edit') || Auth::user()->role == 100)
                                                <a href="{{ route('usuarios.edit', $cliente->id) }}" class="btn btn-info"><i class="fas fa-cogs"></i></a>
                                            @endif--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $clientes->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
