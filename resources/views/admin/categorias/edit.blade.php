@extends('layouts.admin.master')

@section('title', 'Categorias')

@section('header', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias Registradas</a></li>
    <li class="breadcrumb-item active">Editar Categoria</li>
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    {{--FancyBox--}}
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    {{-- FancyBox--}}
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <script>

        jQuery(function ($) {
            $('.table').footable();
        });

        function cambiar(){
            var pdrs = document.getElementById('customFileLang').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }

        function readImage (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    //$('#blah').attr('class', 'img-thumbnail');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileLang").change(function () {
            // Código a ejecutar cuando se detecta un cambio de archivO
            readImage(this);
        });
    </script>
@endsection

{{--
@section('nav-buscar')
    {!! Form::open(['route' => 'usuarios.index', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
        <input type="search" name="buscar" class="form-control form-control-navbar"  placeholder="Buscar Usuario" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
--}}

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Editar Categoria</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-tags"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => ['categorias.update', $categoria->id], 'method' => 'PUT', 'files' => true, 'id' => 'form1']) !!}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    {!! Form::text('nombre', ucwords($categoria->nombre), ['class' => 'form-control', 'placeholder' => 'Nombre de la Categoria', 'required']) !!}
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Modulo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                                    </div>
                                    {!! Form::select('modulo', moduloCategoria() , $categoria->modulo , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Imagen</label>
                                <div class="attachment-block clearfix">
                                    <a href="@if ($categoria->imagen != null){{ asset('img/categorias/'.$categoria->file_path.'/'.$categoria->imagen) }}@else
                                    {{ asset('img/img-placeholder-320x320.png') }}@endif" data-fancybox data-caption="{{ strtoupper($categoria->nombre) }}">
                                        <img id="blah" class="attachment-img" src="@if ($categoria->imagen != null){{ asset('img/categorias/'.$categoria->file_path.'/t_'.$categoria->imagen) }}
                                        @else{{ asset('img/img-placeholder-320x320.png') }}@endif" alt="Categoria Imagen">
                                    </a>
                                    <div class="attachment-pushed">
                                        <div class="attachment-text">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" name="imagen" class="custom-file-input" id="customFileLang" onchange='cambiar()' lang="es" accept="image/jpeg, image/png">
                                                    <label class="custom-file-label" for="customFileLang" data-browse="Elegir" id="info">Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('categorias.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection
