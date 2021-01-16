@extends('layouts.android.master-ogani')

@section('content')
    <section class="mt-3">
        <div class="container">
            @if (false /*!$store*/)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-right">
                            <div class="m-3">
                                <a href="{{ route('android.store.index', Auth::user()->id)  }}" class="text-primary"><i class="fa fa-arrow-circle-left"></i> Store</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3 col-md-5 mt-3">
                    @if (!$ultimos_productos->isEmpty())
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Últimos productos</h4>
                                <div class="latest-product__slider owl-carousel">
                                    @php($primero = [])
                                    @foreach ($ultimos_productos as $producto)

                                        @if ($producto->cant_inventario)
                                            @if ($producto->visibilidad && $producto->descuento)
                                                @php($precio = '
                                                    <span>$'.formatoMillares($producto->precio - $producto->descuento).'</span>
                                                    <span>'.precioBolivares($producto->precio - $producto->descuento).'</span>
                                                ')
                                            @else
                                                @php($precio = '
                                                    <span>$'.formatoMillares($producto->precio).'</span>
                                                    <span>'.precioBolivares($producto->precio).'</span>
                                                ')
                                            @endif
                                        @else
                                            @php($precio = '
                                                    <span class="text-danger">Producto agotado</span>
                                                ')
                                        @endif
                                        @if ($i <= 3)
                                            @php($primero[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $producto->id]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$producto->file_path.'/'.$producto->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($producto->nombre).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')
                                        @else
                                            @php($segundo[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $producto->id]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$producto->file_path.'/'.$producto->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($producto->nombre).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')
                                        @endif
                                        @php($i++)

                                    @endforeach
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
                                    @if (isset($segundo))
                                        <div class="latest-prdouct__slider__item">
                                            @for ($j = 4; $j <= count($segundo) + 3; $j++)
                                                {!!  $segundo[$j]  !!}
                                            @endfor
                                        </div>
                                    @endif
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
                    @endif
                </div>
                <div class="col-lg-9 col-md-7">
                    @if (!$en_oferta->isEmpty())
                        <div class="product__discount">
                            <div class="section-title product__discount__title">
                                <h2>En Oferta</h2>
                            </div>
                            <div class="row">
                                <div class="product__discount__slider owl-carousel">
                                    @foreach ($en_oferta as $producto)
                                        <div class="col-lg-4">
                                            <div class="product__discount__item">
                                                <div class="product__discount__item__pic set-bg img-thumbnail"
                                                     data-setbg="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}">
                                                    <div class="product__discount__percent">-{{ formatoMillares(obtenerPorcentaje($producto->descuento, $producto->precio), 0) }}%</div>
                                                    <ul class="product__item__pic__hover">
                                                        <li>
                                                            <a href="#" content="{{ $producto->id }}"
                                                            class="btn_favoritos favoritos_{{ $producto->id }} @if ($producto->favoritos) fondo-favoritos @endif">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </li>
                                                        <li><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}"><i class="fa fa-eye"></i></a></li>
                                                        <li>
                                                            <a href="#" content="{{ $producto->id }}"
                                                               class="btn_carrito  carrito_{{ $producto->id }} @if ($producto->carrito) fondo-favoritos @endif">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__discount__item__text">
                                                    <span>{{ ucwords($producto->categorias->nombre) }}</span>
                                                    <h5><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}">{{ ucwords($producto->nombre) }}</a></h5>
                                                    <div class="product__item__price">
                                                        ${{ formatoMillares($producto->precio - $producto->descuento) }}
                                                        <s class="text-muted"><small>${{ formatoMillares($producto->precio) }}</small></s>
                                                        <p>{{ precioBolivares($producto->precio - $producto->descuento) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{--<div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ asset('ogani/img/product/discount/pd-2.jpg') }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>Vegetables</span>
                                                <h5><a href="{{ route('android.shop_detail') }}">Vegetables’package</a></h5>
                                                <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ asset('ogani/img/product/discount/pd-3.jpg') }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>Dried Fruit</span>
                                                <h5><a href="{{ route('android.shop_detail') }}">Mixed Fruitss</a></h5>
                                                <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ asset('ogani/img/product/discount/pd-4.jpg') }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>Dried Fruit</span>
                                                <h5><a href="{{ route('android.shop_detail') }}">Raisin’n’nuts</a></h5>
                                                <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ asset('ogani/img/product/discount/pd-5.jpg') }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>Dried Fruit</span>
                                                <h5><a href="{{ route('android.shop_detail') }}">Raisin’n’nuts</a></h5>
                                                <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ asset('ogani/img/product/discount/pd-6.jpg') }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>Dried Fruit</span>
                                                <h5><a href="{{ route('android.shop_detail') }}">Raisin’n’nuts</a></h5>
                                                <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                            </div>
                                        </div>
                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!$productos->isEmpty())
                    <div class="filter__item">
                        <div class="row">
                            {{--<div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>--}}
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ cerosIzquierda($total) }}</span> Productos encontrados</h6>
                                </div>
                            </div>
                            {{--<div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <div class="row">

                        @foreach ($productos as $producto)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg img-thumbnail" data-setbg="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}">
                                        <ul class="product__item__pic__hover">
                                            <li>
                                                <a href="#" id="favoritos_{{ $producto->id }}" content="{{ $producto->id }}"
                                                   class="btn_favoritos @if ($producto->favoritos) fondo-favoritos @endif">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </li>
                                            <li><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}"><i class="fa fa-eye"></i></a></li>
                                            <li>
                                                <a href="#" id="carrito_{{ $producto->id }}" content="{{ $producto->id }}"
                                                   class="btn_carrito @if ($producto->carrito) fondo-favoritos @endif">
                                                   <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}">{{ ucwords($producto->nombre) }}</a></h6>
                                        @if ($producto->cant_inventario)
                                            @if ($producto->visibilidad && $producto->descuento)
                                                <h5>${{ formatoMillares($producto->precio - $producto->descuento) }}</h5>
                                                <h5>{{ precioBolivares($producto->precio - $producto->descuento) }}</h5>
                                            @else
                                                <h5>${{ formatoMillares($producto->precio) }}</h5>
                                                <h5>{{ precioBolivares($producto->precio) }}</h5>
                                            @endif
                                        @else
                                            {{--<h5>${{ formatoMillares($producto->precio) }}</h5>--}}
                                            <h5 class="text-danger">Producto agotado</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        {{--<div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-2.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-3.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-4.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-5.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-6.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-7.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-8.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-9.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-10.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-11.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-12.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('android.shop_detail') }}">Crab Pool Security</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                    {{--<div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>--}}

                    @else

                        <div class="banner mt-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="banner__pic">
                                            <img src="{{ asset('img/store/banner_inventario.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn_favoritos").click(function(e){
            e.preventDefault();
            Swal.fire({
                toast: true,
                //title: 'Cargando...',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.favoritos') }}",
                data: {id_producto:producto},
                success: function (data) {
                    Swal.fire({
                        toast: true,
                        title: data.message,
                        //text: "Bienvenido, puedes empezar a comprar.",
                        icon: data.type,
                        //showConfirmButton: false,
                        //confirmButtonColor: '#3085d6',
                    });
                    if(data.type == "success"){
                        var oferta = document.getElementsByClassName(data.clase);
                        if(oferta){
                            for (var i = 0; i<oferta.length; i++) {
                                oferta[i].classList.add('fondo-favoritos');
                            }
                        }
                        document.getElementById(data.id).classList.add('fondo-favoritos');

                    }else{
                        var oferta = document.getElementsByClassName(data.clase);
                        if(oferta){
                            for (var i = 0; i<oferta.length; i++) {
                                oferta[i].classList.remove('fondo-favoritos');
                            }
                        }
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }

                }
            });
        });

        $(".btn_carrito").click(function(e){
            e.preventDefault();
            Swal.fire({
                toast: true,
                //title: 'Cargando...',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.carrito') }}",
                data: {id_producto:producto},
                success: function (data) {
                    Swal.fire({
                        //toast: true,
                        icon: data.type,
                        title: data.title,
                        //text: data.message,
                        html: data.message,
                        //showConfirmButton: false,
                        //confirmButtonColor: '#3085d6',
                    });
                    if(data.type === "success"){
                        var oferta = document.getElementsByClassName(data.clase);
                        if(oferta){
                            for (var i = 0; i<oferta.length; i++) {
                                oferta[i].classList.add('fondo-favoritos');
                            }
                        }
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }/*else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }*/

                }
            });
        });

    </script>
@endsection
