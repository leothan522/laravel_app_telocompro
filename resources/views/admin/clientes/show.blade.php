@extends('layouts.admin.master')

@section('title', 'Clientes')

@section('header', 'Clientes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes Registrados</a></li>
    <li class="breadcrumb-item active">Ver Cliente</li>
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

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-purple card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle bg-light" src="{{ asset('img/user.png') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ ucwords($cliente->usuario->name) }}</h3>

                        <p class="text-muted text-center">{!! iconoPlataforma($cliente->usuario->plataforma) !!} <small>ID Cliente: {{ $cliente->id }}</small></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ $cliente->usuario->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Cedula</b> <a class="float-right">{{ formatoMillares($cliente->cedula, 0) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nombre Completo</b> <a class="float-right text-danger">{{ strtoupper($cliente->nombre) }} {{ strtoupper($cliente->apellidos) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Teféfono</b> <a class="float-right">{{ $cliente->telefono }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pedidos</b> <a class="float-right">{{ formatoMillares($cliente->num_pedidos, 0) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gasto Total</b> <a class="float-right">{{ formatoMillares($cliente->gasto_dolar) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Dirección de envio</b> <a class="float-right">{{ strtoupper($cliente->direccion_1) }} {{ strtoupper($cliente->direccion_2) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Localidad / Ciudad</b> <a class="float-right">{{ $cliente->localidad }}</a>
                            </li>

                        </ul>

                        @if ((leerJson(Auth::user()->permisos, 'clientes.edit') || Auth::user()->role == 100))
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-danger btn-block"><b>Editar Datos Cliente</b></a>
                        @endif


                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Pedidos Realizados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-shopping-bag"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        hola

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('clientes.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection
