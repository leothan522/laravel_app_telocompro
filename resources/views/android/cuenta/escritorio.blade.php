@extends('layouts.android.master')

@section('pace', '')

@section('content')

    <div class="col-md-12">
        <div class="card card-purple card-outline">
            <div class="card-body box-profile">

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Rol</b> <a class="float-right">{{ role(Auth::user()->role) }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Estatus</b> <a class="float-right text-danger">{!! status(Auth::user()->status) !!}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Registro</b> <a class="float-right">{{ haceCuanto(Auth::user()->created_at) }}</a>
                    </li>
                </ul>

            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
