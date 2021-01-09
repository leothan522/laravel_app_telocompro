@extends('layouts.android.master-ogani')

@section('link')

@endsection

@section('script')
    <script>
        /*$(document).on("click", "#btn_statusHours", function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¡Abierto!',
                text: "Bienvenido, puedes empezar a comprar.",
                icon: 'success',
                confirmButtonColor: '#3085d6',
            });
        });*/
        function storeHours($title, $text, $icono) {
            //this.preventDefault();
            Swal.fire({
                title: $title,
                text: $text,
                icon: $icono,
                confirmButtonColor: '#3085d6',
            });
        }
    </script>
@endsection

@section('content')


    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__search">
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ $telefono_numero->valor }}</h5>
                                <span>{{ $telefono_texto->valor }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ asset('ogani/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>TE LO COMPRO</span>
                            <h2>Frase <br />Publicitaria</h2>
                            <p>Delivery Available</p>
                            <a href="#" id="btn_statusHours" @if(storeHours())
                                class="btn btn-success" onclick="storeHours('¡Abierto!', 'Bienvenido, puedes empezar a comprar.', 'success')"
                               @else
                                class="btn btn-danger" onclick="storeHours('¡Cerrado!', 'Lo sentimos, por ahora estamos descansando. Intentalo mas tarde.', 'warning')"
                               @endif
                                >
                                <strong>@if(storeHours()) <i class="icon fa fa-check"></i> ¡Abierto! @else <i class="icon fa fa-lock"></i> ¡Cerrado! @endif</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    @if (!$categorias->isEmpty())
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($categorias as $categoria)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg img-thumbnail" style="border-radius: 10px;"
                             @if ($categoria->imagen)
                                data-setbg="{{ asset('img/categorias/'.$categoria->file_path.'/t_'.$categoria->imagen) }}">
                                @else
                                data-setbg="{{ asset('img/img-placeholder-320x320.png') }}">
                             @endif
                            <h5><a href="{{ route('android.shop_grid') }}">{{ $categoria->nombre }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                    {{--<div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('ogani/img/categories/cat-1.jpg') }}">
                            <h5><a href="{{ route('android.shop_grid') }}">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('ogani/img/categories/cat-2.jpg') }}">
                            <h5><a href="{{ route('android.shop_grid') }}">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('ogani/img/categories/cat-3.jpg') }}">
                            <h5><a href="{{ route('android.shop_grid') }}">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('ogani/img/categories/cat-4.jpg') }}">
                            <h5><a href="{{ route('android.shop_grid') }}">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('ogani/img/categories/cat-5.jpg') }}">
                            <h5><a href="{{ route('android.shop_grid') }}">drink fruits</a></h5>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Categories Section End -->
    @if (!$ultimos_productos->isEmpty())
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Últimos productos</h4>
                        <div class="latest-product__slider owl-carousel">
                            @php($primero = [])
                            @foreach ($ultimos_productos as $producto)

                            @if ($i <= 3)
                                @php($primero[$i] = '
                                    <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="'.asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen).'" style="width:110px !important;" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>'.ucwords($producto->nombre).'</h6>
                                        <span>$'.formatoMillares($producto->precio).'</span>
                                    </div>
                                    </a>
                                ')
                                @else
                                    @php($segundo[$i] = '
                                        <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="'.asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen).'" style="width:110px !important;" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>'.ucwords($producto->nombre).'</h6>
                                        <span>$'.formatoMillares($producto->precio).'</span>
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
                                </div>
                                @if (isset($segundo))
                                <div class="latest-prdouct__slider__item">
                                    @for ($j = 4; $j <= count($segundo) + 3; $j++)
                                        {!!  $segundo[$j]  !!}
                                    @endfor
                                </div>
                                @endif
                           {{-- <img src="#" alt="#" >--}}
                        </div>
                    </div>
                </div>
               {{-- <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Productos mejor valorados</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>--}}
               {{-- <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Revisar productos</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Productos destacados</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-1.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-2.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-3.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-4.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-5.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-6.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-7.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-8.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->



@endsection
