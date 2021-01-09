@extends('layouts.admin.master')

@section('title', 'Productos')

@section('header', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos Registrados</a></li>
    <li class="breadcrumb-item active">Crear Producto</li>
@endsection

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">

    {{--FancyBox--}}
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- FancyBox--}}
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function () {
            // Summernote
            $('.textarea').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            })
        })

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

        $('#select_estado').change(function () {
            var clase = null;
            var estado = document.getElementById('select_estado');
            //document.f1.municipios_id[document.f1.municipios_id.selectedIndex].value
            var opcion = estado[estado.selectedIndex].value;
            if(opcion == 1){
                opcion = "Publicar Producto";
                clase = "btn btn-block btn-success";
            }else{
                opcion = "Guardar Borrador"
                clase = "btn btn-block btn-info";
            }
            $('#boton_publicar').attr('value', opcion).attr('class', clase)
        });

        document.addEventListener('DOMContentLoaded', function () {
            var clase = null;
            var estado = document.getElementById('select_estado');
            var opcion = estado[estado.selectedIndex].value;
            if(opcion == 1){
                opcion = "Publicar Producto";
                clase = "btn btn-block btn-success";
            }else{
                opcion = "Guardar Borrador"
                clase = "btn btn-block btn-info";
            }
            $('#boton_publicar').attr('value', opcion).attr('class', clase)
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

        {!! Form::open(['route' => 'productos.store', 'method' => 'post', 'files' => true]) !!}

        <div class="row justify-content-center">

                <div class="col-md-6">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Nuevo Producto</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-box"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                            </div>
                                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del producto']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">SKU</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'Codigo unico del producto']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Categoria</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    {!! Form::select('categorias_id', $categorias , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Precio</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            {!! Form::number('precio', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Inventario</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                            </div>
                                            {!! Form::number('cant_inventario', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Poca existencia</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-level-down-alt"></i></span>
                                            </div>
                                            {!! Form::number('poca_existencia', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                     'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Peso</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                            </div>
                                            {!! Form::number('peso', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Und. Peso</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                                            </div>
                                            {!! Form::select('und_peso', undPeso() , 0 , ['class' => 'custom-select']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Max. Carrito </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                                            </div>
                                            {!! Form::number('max_carrito', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="form-group">
                                <label for="name">Vendido individualmente</label>
                                <div class="custom-control custom-checkbox">
                                    <input name="venta_individual" class="custom-control-input" type="checkbox" id="customCheckbox2" value="1">
                                    <label for="customCheckbox2" class="custom-control-label text-sm text-muted">
                                        Activa esto para permitir que solo se pueda comprar uno de estos artículos en cada pedido</label>
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="form-group">
                                <label for="name">Descripción corta del producto</label>
                                <textarea name="descripcion" class="textarea" placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Publicar</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Estado</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    </div>
                                    {!! Form::select('estado', estadoProducto() , 0 , ['class' => 'custom-select', 'id' => 'select_estado', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">En Oferta <span class="text-xs text-danger">(descuento)</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="visibilidad" value="1" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"><i class="fas fa-dollar-sign"></i></label>
                                        </div>
                                        </span>
                                    </div>
                                    {{--{!! Form::select('visibilidad', visibilidadProducto() , 0 , ['class' => 'custom-select', 'required']) !!}
                                    --}}{!! Form::number('descuento', null, ['class' => 'form-control', 'placeholder' => 'Descuento',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <input type="submit" id="boton_publicar" class="btn btn-block btn-info" value="Guardar Borrador">
                            </div>

                        </div>
                    </div>
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Imagen del Producto</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-image"></i></span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                {{--<label for="exampleInputEmail1">Imagen</label>--}}
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

                        </div>
                    </div>
                </div>


        </div>
        {!! Form::close() !!}
    </div>


@endsection
