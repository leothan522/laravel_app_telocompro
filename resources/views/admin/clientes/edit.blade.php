@extends('layouts.admin.master')

@section('title', 'Clientes')

@section('header', 'Clientes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes Registrados</a></li>
    <li class="breadcrumb-item active">Editar Cliente</li>
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
            <div class="col-sm-4">
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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

                        {{--@if ((leerJson(Auth::user()->permisos, 'clientes.edit') || Auth::user()->role == 100))
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-danger btn-block"><b>Editar Datos Cliente</b></a>
                        @endif
--}}

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                {{--<div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Pedidos Realizados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-shopping-bag"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        hola

                    </div>
                </div>--}}
                <div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Editar Datos Cliente</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-child"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <label for="name">{{ __('Cedula') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                {!! Form::number('cedula', $cliente->cedula, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                {!! Form::text('nombre', strtoupper($cliente->nombre), ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Apellidos</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                {!! Form::text('apellidos', strtoupper($cliente->apellidos), ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Teléfono</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                {!! Form::text('telefono', $cliente->telefono, ['class' => 'form-control', 'placeholder' => 'Teléfono', 'required'/*, 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask'*/]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Dirección de envio</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                --}}{!! Form::text('direccion_1', strtoupper($cliente->direccion_1), ['class' => 'form-control', 'placeholder' => 'Número de la casa y nombre de la calle', 'required']) !!}
                            </div>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                --}}{!! Form::text('direccion_2', strtoupper($cliente->direccion_2), ['class' => 'form-control', 'placeholder' => 'Apartamento, habitación, etc. (opcional)']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Localidad / Ciudad</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                </div>
                                {!! Form::text('localidad', strtoupper($cliente->localidad), ['class' => 'form-control', 'placeholder' => 'Sector / Urbanización / Barrio', 'required']) !!}
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Role') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                </div>
                                {!! Form::select('role', role() , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                            </div>
                        </div>--}}
                        {{--@if ($errors->any())
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif--}}

                        <div class="form-group text-right">
                            {{--<input type="hidden" name="id_cliente" value="{{ $id_cliente }}">
                            <input type="hidden" name="opcion" value="{{ $opcion }}">--}}
                            <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('clientes.show', $cliente->id) }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection
