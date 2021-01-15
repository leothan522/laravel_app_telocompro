@extends('layouts.android.master')

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        $('[data-mask]').inputmask();
    </script>
@endsection

@section('content')

    <div class="col-sm-12 text-center">
        @include('flash::message')
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

    <div class="card card-purple">
        {{--<div class="card-header">
            <h5 class="card-title">{{ ucwords(Auth::user()->name) }}</h5>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-user-plus"></i></span>
            </div>
        </div>
        --}}<div class="card-body">

            {!! Form::open(['route' => ['android.facturacion.update', Auth::user()->id], 'method' => 'post']) !!}

            <div class="form-group">
                <label for="name">{{ __('Cedula') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    {!! Form::number('cedula', $cedula, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    {!! Form::text('nombre', strtoupper($nombre), ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="name">Apellidos</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    {!! Form::text('apellidos', strtoupper($apellidos), ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Teléfono</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    {!! Form::text('telefono', $telefono, ['class' => 'form-control', 'placeholder' => 'Teléfono', 'required'/*, 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask'*/]) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email">Dirección de envio</label>
                <div class="input-group mb-3">
                    {{--<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    --}}{!! Form::text('direccion_1', strtoupper($direccion_1), ['class' => 'form-control', 'placeholder' => 'Número de la casa y nombre de la calle', 'required']) !!}
                </div>
                <div class="input-group mb-3">
                    {{--<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    --}}{!! Form::text('direccion_2', strtoupper($direccion_2), ['class' => 'form-control', 'placeholder' => 'Apartamento, habitación, etc. (opcional)']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Localidad / Ciudad</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    {!! Form::text('localidad', strtoupper($localidad), ['class' => 'form-control', 'placeholder' => 'Sector / Urbanización / Barrio', 'required']) !!}
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
                <input type="hidden" name="id_cliente" value="{{ $id_cliente }}">
                <input type="hidden" name="opcion" value="{{ $opcion }}">
                {{--<input type="submit" class="btn btn-block bg-orange--}}{{--{{ $class }}--}}{{--" style="color: white;" value="{{ $boton }}">--}}
                <button type="submit" class="btn btn-block bg-orange"><span class="text-bold" style="color: white;">{{ $boton }}</span></button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection
