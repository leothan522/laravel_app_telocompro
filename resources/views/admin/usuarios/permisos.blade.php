@extends('layouts.admin.master')

@section('title', 'Usuarios')

@section('header', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios Registrados</a></li>
    <li class="breadcrumb-item active">Permisos de Usuarios</li>
@endsection

{{--@section('nav-a')
    @if (leerJson(Auth::user()->permisos, 'admin.dashboard'))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
        </li>
    @endif

@endsection--}}

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="user-block">
                            <a href="#" data-toggle="modal" data-target="#modal-default">
                                <img class="img-circle img-bordered-sm bg-light" src="{{ asset('img/user.png') }}" alt="user image">
                            </a>
                            <span class="username">
                                <a href="#">{{ ucwords($user->name) }}</a>
                            </span>
                            <span class="description">
                                {{ $user->email }}
                                <strong>({{ role($user->role) }})</strong>
                            </span>
                        </div>
                        <div class="card-tools">
                            <span class="btn btn-tool">ID: {{ $user->id }}</span>
                           {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}
        <div class="row justify-content-center">
            @if ($user->role > 0)
                <div class="col-md-3">
                    <label class="col-md-12"><i class="fa fa-tachometer-alt"></i> Dashboard</label>
                    @include('admin.usuarios.permisos.dashboard')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><i class="fa fa-store"></i> E-commerce</label>
                    @include('admin.usuarios.permisos.modulo_horarios')
                    @include('admin.usuarios.permisos.modulo_ajustes')
                    @include('admin.usuarios.permisos.modulo_clientes')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><i class="fa fa-box"></i> Productos</label>
                    @include('admin.usuarios.permisos.modulo_productos')
                    @include('admin.usuarios.permisos.modulo_categorias')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><i class="fa fa-user"></i> Usuarios</label>
                    @include('admin.usuarios.permisos.modulo_usuarios')
                </div>

                @else
                @include('admin.usuarios.permisos.blanco')
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <input type="hidden" name="mod" value="permisos">
                <button type="submit" class="btn btn-block btn-primary">Guardar Permisos</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn_crear_usuario = document.getElementById('optionUsuarios1');
            var btn_usuarios_store = document.getElementById('optionUsuariosp1');
            btn_crear_usuario.addEventListener('click', function () {
               btn_usuarios_store.click();
            });
            var btn_horarios = document.getElementById('tituloHorarios');
            var btn_opcionHorarios = document.getElementById('optionHorarios2');
            btn_horarios.addEventListener('click', function () {
                btn_opcionHorarios.click();
            });
            btn_opcionHorarios.addEventListener('click', function () {
                btn_horarios.click();
            });

            var btn_ajustes = document.getElementById('tituloAjustes');
            var btn_opcionAjustes = document.getElementById('optionAjustes2');
            btn_ajustes.addEventListener('click', function () {
                btn_opcionAjustes.click();
            });
            btn_opcionAjustes.addEventListener('click', function () {
                btn_ajustes.click();
            });
        });
    </script>
@endsection
