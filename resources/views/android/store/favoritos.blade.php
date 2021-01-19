@extends('layouts.android.master-ogani')

@section('content')
    @if (!$favoritos->isEmpty())
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                {{--<h4>Últimos productos</h4>--}}
                                <div class="latest-product__slider owl-carousel">
                                    @php($primero = [])
                                    @foreach ($favoritos as $parametro)
                                        @if ($parametro->precio < 0 || !$parametro->estado)
                                            @continue(true)
                                        @endif
                                        @if ($parametro->cant_inventario)
                                            @if ($parametro->visibilidad && $parametro->descuento)
                                                @php($precio = '
                                                    <span>$'.formatoMillares($parametro->precio - $parametro->descuento).'</span>
                                                    <span>'.precioBolivares($parametro->precio - $parametro->descuento).'</span>
                                                ')
                                            @else
                                                @php($precio = '
                                                    <span>$'.formatoMillares($parametro->precio).'</span>
                                                    <span>'.precioBolivares($parametro->precio).'</span>
                                                ')
                                            @endif
                                        @else
                                            @php($precio = '
                                                    <span class="text-danger">Producto agotado</span>
                                                ')
                                        @endif
                                        @if (true /*$i <= 3*/)
                                            @php($primero[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $parametro->valor]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$parametro->file_path.'/'.$parametro->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($parametro->nombre_producto).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')
                                        {{--@else
                                            @php($segundo[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $parametro->id]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$parametro->file_path.'/'.$parametro->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($parametro->nombre).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')--}}
                                        @endif
                                        @php($i++)

                                    @endforeach
                                    @if (!empty($primero))
                                    <div class="latest-prdouct__slider__item">
                                        @for ($j = 1; $j <= count($primero); $j++)
                                            {!!  $primero[$j]  !!}
                                        @endfor
                                        {{--<a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>--}}
                                        {{--<a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>--}}
                                    </div>
                                        @php($hero = false)
                                        @else
                                        @php($hero = true)
                                    @endif
                                    {{--@if (isset($segundo))
                                        <div class="latest-prdouct__slider__item">
                                            @for ($j = 4; $j <= count($segundo) + 3; $j++)
                                                {!!  $segundo[$j]  !!}
                                            @endfor
                                        </div>
                                    @endif--}}
                                    {{--<div class="latest-prdouct__slider__item">
                                        <a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('android.shop_detail') }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        @php($hero = true)
    @endif
    @if ($hero)
        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__search">
                            {{--<div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>{{ $telefono_numero }}</h5>
                                    <span>{{ $telefono_texto }}</span>
                                </div>
                            </div>--}}
                        </div>
                        <div class="hero__item set-bg" data-setbg="{{ asset('img/banner_2.png') }}">
                            <div class="hero__text">
                                <span>#TELOCOMPRO</span>
                                <h2>{{--Frase <br/>Publicitaria--}}</h2>
                                <p>¡Aún no tienes favoritos!</p>
                                <a href="{{ route('android.store.index', Auth::user()->id) }}" id="btn_statusHours" class="btn btn-info">
                                    <strong style="color: white;">{{--<i class="icon fa fa-exclamation-circle"></i>--}} Ir a Store</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    @endif
@endsection

