@extends('layouts.admin.master')

@section('title', 'Escritorio')

@section('header', 'Escritorio')

@section('breadcrumb')
    <li class="breadcrumb-item @if(storeHours()) bg-success @else bg-danger @endif active p-1" style="border-radius: 5px;">
        <a href="{{ route('horarios.index') }}">
        {{--Status: --}}<strong>@if(storeHours()) <i class="icon fas fa-check"></i> ¡Abierto! @else <i class="icon fas fa-lock"></i> ¡Cerrado! @endif</strong>
        </a>
    </li>
@endsection

@section('nav-buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        /*document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool',
            })
        });*/
        /*Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })*/
        /*$(document).on("click", ".show-alert-", function(e) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form_delete_').submit();
                }
            })
        });*/

        /*function alertaBorrar(id){
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form_delete_' + id).submit();
                }
            })
        }*/
    </script>
@endsection

@section('content')

    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><a href="{{ route('ajustes.index') }}"><i class="fas fa-dollar-sign"></i></a></span>
                <div class="info-box-content">
                    <span class="info-box-text">Precio del dolar</span>
                    <span class="info-box-number">
                    {{ formatoMillares($dolar->valor) }}
                    <small>Bs. <span class="text-danger text-xs d-inline-block">{{ haceCuanto($dolar->updated_at) }}</span></small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><a href="{{ route('productos.ver', 1) }}"><i class="fas fa-box"></i></a></span>
                <div class="info-box-content">
                    <span class="info-box-text">Productos Publicados</span>
                    <span class="info-box-number">{{ $publicados }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-bag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pedidos</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><a href="{{ route('usuarios.role', 0) }}"><i class="fas fa-users"></i></a></span>
                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{ formatoMillares($clientes, 0) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">

    <!-- Default box -->
    <div class="col-md-8">
        {{--<div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                Start creating your amazing application! tonatha
                --}}{{--<button type="button" class="btn btn-info" onclick="alertaBorrar('form_delete_{{ 1 }}')"><i class="fas fa-trash"></i></button>--}}{{--
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>--}}
        <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Orders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>iPhone 6 Plus</td>
                                <td><span class="badge badge-danger">Delivered</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-info">Processing</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>iPhone 6 Plus</td>
                                <td><span class="badge badge-danger">Delivered</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Products</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>More</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <img src="{{ asset('adminlte/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Some Product
                            </td>
                            <td>$13 USD</td>
                            <td>
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    12%
                                </small>
                                12,000 Sold
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('adminlte/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Another Product
                            </td>
                            <td>$29 USD</td>
                            <td>
                                <small class="text-warning mr-1">
                                    <i class="fas fa-arrow-down"></i>
                                    0.5%
                                </small>
                                123,234 Sold
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('adminlte/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Amazing Product
                            </td>
                            <td>$1,230 USD</td>
                            <td>
                                <small class="text-danger mr-1">
                                    <i class="fas fa-arrow-down"></i>
                                    3%
                                </small>
                                198 Sold
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('adminlte/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Perfect Item
                                <span class="badge bg-danger">NEW</span>
                            </td>
                            <td>$199 USD</td>
                            <td>
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    63%
                                </small>
                                87 Sold
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
    </div>
    <!-- /.card -->
    <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-signal"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Ventas netas este mes</span>
                <span class="info-box-number"><i class="fa fa-dollar-sign text-xs"></i> 23,00</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fa fa-exclamation-circle"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pedidos en espera</span>
                <span class="info-box-number">92</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-truck"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pedidos por despachar</span>
                <span class="info-box-number">12</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Productos casi sin existencia</span>
                <span class="info-box-number">2</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <!-- /.info-box -->
        <a href="#">
        <div class="info-box mb-3 bg-secondary">
            <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Productos agotados</span>
                <span class="info-box-number">{{ formatoMillares($agotados, 0) }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>

        <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Productos agreados recientemente</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach ($recientes as $reciente)
                        <li class="item">
                        <div class="product-img">
                            <img src="{{ asset('img/productos/'.$reciente->file_path.'/t_'.$reciente->imagen) }}" alt="Producto Imagen" class="img-size-50">
                        </div>
                        <div class="product-info">
                            <a href="{{ route('productos.index', ['buscar' => $reciente->nombre]) }}" class="product-title">{{ ucwords($reciente->nombre) }}
                                <span class="badge badge-warning float-right">${{ formatoMillares($reciente->precio) }}</span></a>
                            <span class="product-description">
                                {!! $reciente->descripcion !!}
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('productos.index') }}" class="uppercase">Ver todos los productos</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->

    </div>

@endsection
