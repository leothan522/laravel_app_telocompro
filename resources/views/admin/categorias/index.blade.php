@extends('layouts.admin.master')

@section('title', 'Categorias')

@section('header', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item active">Categorias Registradas</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
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
            @if (leerJson(Auth::user()->permisos, 'categorias.store') || Auth::user()->role == 100)
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Nueva Categoria</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-tags"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'categorias.store', 'method' => 'post', 'files' => true, 'id' => 'form1']) !!}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la Categoria', 'required']) !!}
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
                                    {!! Form::select('modulo', moduloCategoria() , 0 , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Imagen</label>
                                <div class="attachment-block clearfix">
                                    <img id="blah" class="attachment-img" src="{{ asset('img/img-placeholder-320x320.png') }}" alt="Categoria Imagen">
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
                                @if ($todas == 0)
                                    <input type="hidden" name="por_defecto" value="1">
                                @endif
                                <input type="submit" class="btn btn-block btn-success" value="Guardar">
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-8">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Categorias Registradas</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-tags"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <ol class="breadcrumb">
                            @if ($modulo != 100)
                                <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Todas <span class="text-muted">({{ cerosIzquierda($todas) }})</span></a></li>
                                @else
                                <li class="breadcrumb-item active">Todas ({{ cerosIzquierda($todas) }})</li>
                            @endif
                            @if ($modulo != 0)
                                <li class="breadcrumb-item"><a href="{{ route('categorias.modulo', 0) }}">Productos <span class="text-muted">({{ cerosIzquierda($productos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Productos <span class="text-muted">({{ cerosIzquierda($productos) }})</span></li>
                            @endif
                            @if ($modulo != 1)
                                <li class="breadcrumb-item"><a href="{{ route('categorias.modulo', 1) }}">Blog <span class="text-muted">({{ cerosIzquierda($blog) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Blog <span class="text-muted">({{ cerosIzquierda($blog) }})</span></li>
                            @endif

                            {{--@if ($role != 100 || isset($_GET['buscar']))
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Todos <span class="text-muted">({{ cerosIzquierda($todos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Todos ({{ cerosIzquierda($todos) }})</li>
                            @endif
                            --}}
                        </ol>

                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                <th scope="col" class="text-center"><i class="fas fa-image"></i></th>
                                <th scope="col">Nombre</th>
                                <th scope="col" data-breakpoints="xs">Slug</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Modulo</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Productos</th>
                                <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <th scope="row" class="text-center">{{ $categoria->id }}</th>
                                    <td class="text-center">
                                        <div class="product-img">
                                            <a href="@if ($categoria->imagen != null){{ asset('img/categorias/'.$categoria->file_path.'/'.$categoria->imagen) }}
                                                @else
                                                {{ asset('img/img-placeholder-320x320.png') }}
                                            @endif" data-fancybox data-caption="{{ ucwords($categoria->nombre) }}">
                                                <img src="@if ($categoria->imagen != null){{ asset('img/categorias/'.$categoria->file_path.'/t_'.$categoria->imagen) }}
                                                @else
                                                {{ asset('img/img-placeholder-320x320.png') }}
                                                @endif" alt="Categoria Imagen" class="img-size-50">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ ucwords($categoria->nombre) }}</td>
                                    <td>{{ $categoria->slug }}</td>
                                    <td class="text-center">{{ moduloCategoria($categoria->modulo) }}</td>
                                    <td class="text-center">{{ formatoMillares($categoria->num_productos, 0) }}</td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['categorias.destroy', $categoria->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$categoria->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'categorias.edit') || Auth::user()->role == 100)
                                                {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $categoria->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>--}}
                                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'categorias.destroy') || Auth::user()->role == 100)
                                                @if ($categoria->por_defecto != 1)
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $categoria->id }}')" class="btn btn-info">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-info disabled"><i class="fas fa-trash"></i></button>
                                                @endif
                                            @endif
                                        </div>
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $categorias->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
