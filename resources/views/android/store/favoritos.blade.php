@extends('layouts.android.master-ogani')

@section('content')
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
                                        @if ($parametro->productos->visibilidad && $parametro->productos->descuento)
                                            @php($precio = '
                                                <span>$'.formatoMillares($parametro->productos->precio - $parametro->productos->descuento).'</span>
                                                <span>'.precioBolivares($parametro->productos->precio - $parametro->productos->descuento).'</span>
                                            ')
                                        @else
                                            @php($precio = '
                                                <span>$'.formatoMillares($parametro->productos->precio).'</span>
                                                <span>'.precioBolivares($parametro->productos->precio).'</span>
                                            ')
                                        @endif
                                        @if (true /*$i <= 3*/)
                                            @php($primero[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $parametro->productos->id]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$parametro->productos->file_path.'/'.$parametro->productos->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($parametro->productos->nombre).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')
                                        {{--@else
                                            @php($segundo[$i] = '
                                                <a href="'.route('android.detalles', [Auth::user()->id, $parametro->productos->id]).'" class="latest-product__item">
                                                    <div class="latest-product__item__pic img-thumbnail">
                                                        <img src="'.asset('img/productos/'.$parametro->productos->file_path.'/'.$parametro->productos->imagen).'" style="width:110px !important;" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>'.ucwords($parametro->productos->nombre).'</h6>
                                                        '.$precio.'
                                                    </div>
                                                </a>
                                            ')--}}
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
@endsection

