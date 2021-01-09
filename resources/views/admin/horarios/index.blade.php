@extends('layouts.admin.master')

@section('title', 'Store Hours')

@section('header', 'Store Hours')

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Store Hours Registradas</a></li>--}}
    <li class="breadcrumb-item active">Horarios</li>
@endsection

@section('link')
    <!-- Datatables -->
    {{--<link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    --}}{{--FancyBox--}}{{--
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">--}}
@endsection

@section('script')
    {{--<!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    --}}{{-- FancyBox--}}{{--
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
--}}
    <script>

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
                <div class="col-md-7">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Store Hours</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-clock"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' =>  'horarios.store', 'method' => 'POT', 'id' => 'form1']) !!}

                            <div class="form-group">
                                <label for="name">Horarios</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-power-off"></i></span>
                                    </div>
                                    {!! Form::select('horarios', estadosHorarios() , $horarios , ['class' => 'custom-select']) !!}
                                </div>
                                <div class="alert @if(storeHours()) alert-success @else alert-danger @endif {{--alert-dismissible--}}">
                                    @if (storeHours())
                                        <h5><i class="icon fas fa-check"></i> ¡Abierto!</h5>
                                        @else
                                        <h5><i class="icon fas fa-lock"></i> ¡Cerrado!</h5>
                                    @endif
                                    {{--Dia: {{ date('D') }}.--}}Hora actual: <strong>{{ date('h:i a') }}</strong>. Status: <strong>@if(storeHours()) OPEN @else CLOSED @endif</strong>
                                </div>
                            </div>
                            <hr class="bg-purple">

                            <div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="anulazion_forzada" @if ($anulacion_forzada) checked @endif value="1">
                                    <label for="customCheckbox1" class="custom-control-label">Activar anulación forzada</label>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                {{--<label for="name">Ordering Status</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-power-off"></i></span>
                                    </div>
                                    {!! Form::select('valor_anulacion_forzada', anulazionForzada() , $valor_anulacion_forzada , ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            <hr class="bg-purple">

                            <div class="form-group">
                                <label for="nose">Periodos</label>

                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Mon') }}" id="custom-tabs-three-lunes-tab" data-toggle="pill"
                                       href="#custom-tabs-three-lunes" role="tab" aria-controls="custom-tabs-three-lunes"
                                       aria-selected="false">Lunes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Tue') }}" id="custom-tabs-three-martes-tab" data-toggle="pill"
                                       href="#custom-tabs-three-martes" role="tab" aria-controls="custom-tabs-three-martes"
                                       aria-selected="false">Martes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Web') }}" id="custom-tabs-three-miercoles-tab" data-toggle="pill"
                                       href="#custom-tabs-three-miercoles" role="tab" aria-controls="custom-tabs-three-miercoles"
                                       aria-selected="false">Miercoles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Thu') }}" id="custom-tabs-three-jueves-tab" data-toggle="pill"
                                       href="#custom-tabs-three-jueves" role="tab" aria-controls="custom-tabs-three-jueves"
                                       aria-selected="false">Jueves</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Fri') }}" id="custom-tabs-three-viernes-tab" data-toggle="pill"
                                       href="#custom-tabs-three-viernes" role="tab" aria-controls="custom-tabs-three-viernes"
                                       aria-selected="false">Viernes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Sat') }}" id="custom-tabs-three-sabado-tab" data-toggle="pill"
                                       href="#custom-tabs-three-sabado" role="tab" aria-controls="custom-tabs-three-sabado"
                                       aria-selected="false">Sabado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ showActive('Sun') }}" id="custom-tabs-three-domingo-tab" data-toggle="pill"
                                       href="#custom-tabs-three-domingo" role="tab" aria-controls="custom-tabs-three-domingo"
                                       aria-selected="false">Domingo</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                {{-- Lunes --}}
                                <div class="tab-pane fade {{ showActive('Mon') }}" id="custom-tabs-three-lunes" role="tabpanel" aria-labelledby="custom-tabs-three-lunes-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="lunes_open" value="{{ $lunes_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="lunes_closed" value="{{ $lunes_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Martes --}}
                                <div class="tab-pane fade {{ showActive('Tue') }}" id="custom-tabs-three-martes" role="tabpanel" aria-labelledby="custom-tabs-three-martes-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="martes_open" value="{{ $martes_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="martes_closed" value="{{ $martes_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Miercoles --}}
                                <div class="tab-pane fade {{ showActive('Wed') }}" id="custom-tabs-three-miercoles" role="tabpanel" aria-labelledby="custom-tabs-three-miercoles-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="miercoles_open" value="{{ $miercoles_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="miercoles_closed" value="{{ $miercoles_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Jueves --}}
                                <div class="tab-pane fade {{ showActive('Thu') }}" id="custom-tabs-three-jueves" role="tabpanel" aria-labelledby="custom-tabs-three-jueves-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="jueves_open" value="{{ $jueves_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="jueves_closed" value="{{ $jueves_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Viernes --}}
                                <div class="tab-pane fade {{ showActive('Fri') }}" id="custom-tabs-three-viernes" role="tabpanel" aria-labelledby="custom-tabs-three-viernes-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="viernes_open" value="{{ $viernes_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="viernes_closed" value="{{ $viernes_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Sabado --}}
                                <div class="tab-pane fade {{ showActive('Sat') }}" id="custom-tabs-three-sabado" role="tabpanel" aria-labelledby="custom-tabs-three-sabado-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="sabado_open" value="{{ $sabado_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="sabado_closed" value="{{ $sabado_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Domingo --}}
                                <div class="tab-pane fade {{ showActive('Sun') }}" id="custom-tabs-three-domingo" role="tabpanel" aria-labelledby="custom-tabs-three-domingo-tab">
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Apertura</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="domingo_open" value="{{ $domingo_open }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cierre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="time" name="domingo_closed" value="{{ $domingo_closed }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>







                            </div>


                            </div>
                            <hr class="bg-purple">
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

        {{--<div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="javascript:history.back()"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>--}}
    </div>


@endsection
