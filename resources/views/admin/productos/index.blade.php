@extends('layouts.admin.master')

@section('title', 'Productos')

@section('header', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item active">Productos Registrados</li>
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

        function accionLote(input) {
            var check = document.getElementById('hiddenCheck' + input)
            check.click();
        }

        function todosCheck(num) {
            for (var i = 1; i <= num; i++) {
                document.getElementById('customCheck' + i).click();
            }
        }

        var btn_aplicar = document.getElementById('btn_aplicar_lote');
        btn_aplicar.addEventListener('click', function () {
            var select = document.getElementById('select_lote');
            var acction = select[select.selectedIndex].value;
            if(acction == 100){
                alertaBorrar('form_lote');
            }else{
                document.getElementById('btn_enviar').click();
            }

        });

        document.getElementById("form_lote").reset();

        /*function cambiar(){
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
        });*/
    </script>
@endsection


@section('nav-buscar')
    {!! Form::open(['route' => 'productos.index', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
        <input type="search" name="buscar" class="form-control form-control-navbar"  placeholder="Buscar Producto" aria-label="Search">
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
                        <h5 class="card-title">Productos Registrados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-box"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <ol class="breadcrumb">
                            @if ($ver != 100 || isset($_GET['buscar']))
                                <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Todos <span class="text-muted">({{ cerosIzquierda($todos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Todos ({{ cerosIzquierda($todos) }})</li>
                            @endif
                            @if ($ver != 1)
                                <li class="breadcrumb-item"><a href="{{ route('productos.ver', 1) }}">Publicado <span class="text-muted">({{ cerosIzquierda($publicado) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Publicado <span class="text-muted">({{ cerosIzquierda($publicado) }})</span></li>
                            @endif
                            @if ($ver != 0)
                                <li class="breadcrumb-item"><a href="{{ route('productos.ver', 0) }}">Borrador <span class="text-muted">({{ cerosIzquierda($borrador) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Borrador <span class="text-muted">({{ cerosIzquierda($borrador) }})</span></li>
                            @endif
                        </ol>
                        <div class="row">

                        @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                        {!! Form::open(['route' => ['productos.acciones_lote'], 'method' => 'post', 'class' => 'col-md-4', 'id' => 'form_lote']) !!}
                            <div class="row">
                                @php($acciones = estadoProducto())
                                @if (leerJson(Auth::user()->permisos, 'productos.destroy') || Auth::user()->role == 100)
                                    @php($acciones[100] = "Eliminar productos")
                                @endif
                                {!! Form::select('accion', $acciones , null , ['class' => 'custom-select col-md-7', 'placeholder' => 'Acciones en lote', 'id' => 'select_lote', 'required']) !!}
                                <div class="d-none">
                                    @php($i = 0)
                                    @foreach ($productos as $producto)
                                        @php($i++)
                                        <input type="checkbox" name="productos_id_{{ $i }}" value="{{ $producto->id }}" id="hiddenCheck{{ $i }}">{{ $i }}
                                    @endforeach
                                    <input type="text" name="total" value="{{ $i }}">
                                    <input type="submit" id="btn_enviar" value="hola">
                                </div>
                                <button type="button" id="btn_aplicar_lote" class="btn btn-outline-primary col-md-4">Aplicar</button>
                            </div>
                        {!! Form::close() !!}
                        @endif

                        {!! Form::open(['route' => ['productos.filtrar'], 'method' => 'post', 'class' => 'col-md-7']) !!}
                            <div class="row">
                                {!! Form::select('categorias_id', $categorias, null , ['class' => 'custom-select col-md-4', 'placeholder' => 'Elige una categoria']) !!}
                                {!! Form::select('estado', ['1' => 'Hay existecias', '0' => 'Agotado'] , null , ['class' => 'custom-select col-md-4 ml-1', 'placeholder' => 'Filtrar por inventario']) !!}
                                <button type="submit" class="btn btn-outline-primary col-md-2 ml-1">Filtrar</button>
                            </div>
                        {!! Form::close() !!}
                        </div>

                        <table class="table table-hover bg-light mt-3">
                            <thead class="thead-dark">
                            <tr>
                                @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                <th scope="col" class="text-center" data-breakpoints="xs" width="5%">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" onclick="todosCheck('{{ $i }}')" class="custom-control-input accion-lote" id="customCheck0">
                                        <label class="custom-control-label" for="customCheck0">{{--{{ $i }}Check this custom checkbox--}}</label>
                                    </div>
                                </th>
                                @endif
                                <th scope="col" class="text-center"><i class="fas fa-image"></i></th>
                                <th scope="col">Nombre</th>
                                <th scope="col" data-breakpoints="xs">SKU</th>
                                <th scope="col" data-breakpoints="xs">Inventario</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Precio $</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Precio Bs.</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Categorías</th>
                                <th scope="col" class="text-center" data-breakpoints="xs">Actualizado</th>
                                <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                            @foreach ($productos as $producto)
                                @php($i++)
                                <tr>
                                    @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                    <th scope="row" class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" onclick="accionLote('{{ $i }}')" class="custom-control-input" id="customCheck{{ $i }}">
                                            <label class="custom-control-label" for="customCheck{{ $i }}">{{--{{ $i }}Check this custom checkbox--}}</label>
                                        </div>
                                    </th>
                                    @endif
                                    <td class="text-center">
                                        <div class="product-img">
                                            <a href="@if ($producto->imagen != null){{ asset('img/productos/'.$producto->file_path.'/'.$producto->imagen) }}
                                            @else
                                            {{ asset('img/img-placeholder-320x320.png') }}
                                            @endif" data-fancybox data-caption="{{ ucwords($producto->nombre) }}">
                                                <img src="@if ($producto->imagen != null){{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}
                                                @else
                                                {{ asset('img/img-placeholder-320x320.png') }}
                                                @endif" alt="Producto Imagen" class="img-size-50">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ucwords($producto->nombre) }}<br>
                                        <span class="text-muted text-sm">
                                            @if ($producto->estado == 0)
                                                <i class="fa fa-eraser"></i>
                                                @else
                                                <i class="fa fa-globe text-primary"></i>
                                            @endif
                                            ID: {{ $producto->id }}</span></td>
                                    <td>{{ strtoupper($producto->sku) }}</td>
                                    <td>
                                        @if ($producto->cant_inventario > 0)
                                            <strong class="text-success badge">Hay existencias</strong>
                                        @else
                                            <strong class="text-danger badge">Agotado</strong>
                                        @endif
                                        <br>({{ formatoMillares($producto->cant_inventario, 0) }})
                                    </td>
                                    <td class="text-center">
                                        @if ($producto->precio > 0)
                                            @if ($producto->visibilidad && $producto->descuento)
                                                <strong class="text-primary badge">En Oferta</strong><br>
                                                <i class="fa fa-dollar-sign text-sm"></i>
                                                {{ formatoMillares($producto->precio - $producto->descuento) }} <br>
                                                <s class="text-sm text-muted">
                                                    <i class="fa fa-dollar-sign text-sm"></i>
                                                    {{ formatoMillares($producto->precio) }}
                                                    </s>
                                                @else
                                                <i class="fa fa-dollar-sign text-sm"></i>
                                                {{ formatoMillares($producto->precio) }}
                                            @endif

                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center badge">
                                        @if ($producto->precio > 0)
                                            @if ($producto->visibilidad && $producto->descuento)
                                                {{ precioBolivares($producto->precio - $producto->descuento) }}
                                            @else
                                                {{ precioBolivares($producto->precio) }}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $producto->categorias->nombre }}</td>
                                    <td class="text-center text-xs">{{ haceCuanto($producto->updated_at) }}</td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$producto->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                                {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $producto->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>--}}
                                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'productos.destroy') || Auth::user()->role == 100)
                                                @if ($producto->por_defecto != 1)
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $producto->id }}')" class="btn btn-info">
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
                                {{ $productos->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
