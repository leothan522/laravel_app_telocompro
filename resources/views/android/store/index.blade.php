@extends('layouts.android.master-ogani')

@section('link')

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
                                <h5>{{ $telefono_numero }}</h5>
                                <span>{{ $telefono_texto }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ asset('img/banner_2.png') }}">
                        <div class="hero__text">
                            <span>#TELOCOMPRO</span>
                            <h2>{{--Frase <br/>Publicitaria--}}</h2>
                            <p>Delivery Disponible</p>
                            <a href="#" id="btn_statusHours" @if(storeHours() && !$productos->isEmpty())
                            class="btn btn-success"
                               onclick="storeHours('¡Abierto!', 'Bienvenido, puedes empezar a comprar.', 'success')"
                               @else
                               class="btn btn-danger"
                               onclick="storeHours('¡Cerrado!', 'Lo sentimos, por ahora estamos descansando. Intentalo mas tarde.', 'warning')"
                                @endif
                            >
                                <strong>@if(storeHours() && !$productos->isEmpty()) <i class="icon fa fa-check"></i> ¡Abierto! @else <i
                                        class="icon fa fa-lock"></i> ¡Cerrado! @endif</strong>
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
                                     data-setbg="{{ asset('img/categorias/'.$categoria->file_path.'/'.$categoria->imagen) }}">
                                    @else
                                        data-setbg="{{ asset('img/img-placeholder-320x320.png') }}">
                                    @endif
                                    <h5>
                                        <a href="{{ route('android.categorias', [Auth::user()->id, $categoria->id]) }}">{{ $categoria->nombre }}</a>
                                    </h5>
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
                            <h4>Últimos Productos</h4>
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
    @if (!$productos->isEmpty())
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Productos Destacados</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Todos</li>
                            @foreach ($categorias as $categoria)
                                <li data-filter=".{{ $categoria->slug }}">{{ $categoria->nombre }}</li>
                            @endforeach
                            {{--<li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($productos as $producto)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $producto->categorias->slug }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg img-thumbnail"
                                 data-setbg="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="#" id="favoritos_{{ $producto->id }}" content="{{ $producto->id }}"
                                           class="btn_favoritos @if ($producto->favoritos) fondo-favoritos @endif">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </li>
                                    <li><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li>
                                        <a href="#" id="carrito_{{ $producto->id }}" content="{{ $producto->id }}"
                                           class="btn_carrito @if ($producto->carrito) fondo-favoritos @endif">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6>
                                    <a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}">{{ ucwords($producto->nombre) }}</a>
                                </h6>
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
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
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
                </div>--}}
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

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




@endsection

@section('script')
    <script type="text/javascript">
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
            Swal.fire({
                title: $title,
                text: $text,
                icon: $icono,
                confirmButtonColor: '#3085d6',
            });
        }

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
                        //text: data.message,
                        icon: data.type,
                        //showConfirmButton: false,
                        //confirmButtonColor: '#3085d6',
                    });
                    if(data.type === "success"){
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }else{
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
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }/*else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }*/

                }
            });
        });

    </script>
@endsection
