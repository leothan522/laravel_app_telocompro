@extends('layouts.android.master-ogani')

@section('content')
        {{--<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <div style="margin-top: 16px;">
                            <a href="./index.html" class="text-muted">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    <section>
        <div class="container">
            {{--<div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <div class="m-3">
                            <a href="javascript:history.back()" class="text-primary"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-lg-6 col-md-6 mt-3">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item img-thumbnail">
                            <img class="product__details__pic__item--large"
                                 src="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @if ($galeria->isNotEmpty())
                            <img data-imgbigurl="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}"
                                 src="{{ asset('img/productos/'.$producto->file_path.'/t_'.$producto->imagen) }}" class="img-thumbnail" alt="">
                            @foreach ($galeria as $imagen)
                                <img data-imgbigurl="{{ asset('img/productos_galeria/'.$imagen->file_path.'/t_'.$imagen->imagen) }}"
                                     src="{{ asset('img/productos_galeria/'.$imagen->file_path.'/t_'.$imagen->imagen) }}" class="img-thumbnail" alt="">
                            @endforeach
                            @endif
                            {{--<img data-imgbigurl="{{ asset('ogani/img/product/details/product-details-2.jpg') }}"
                                 src="{{ asset('ogani/img/product/details/thumb-1.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('ogani/img/product/details/product-details-3.jpg') }}"
                                 src="{{ asset('ogani/img/product/details/thumb-2.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('ogani/img/product/details/product-details-5.jpg') }}"
                                 src="{{ asset('ogani/img/product/details/thumb-3.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('ogani/img/product/details/product-details-4.jpg') }}"
                                 src="{{ asset('ogani/img/product/details/thumb-4.jpg') }}" alt="">--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ ucwords($producto->nombre) }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">
                            @if ($producto->cant_inventario)
                                @if ($producto->visibilidad && $producto->descuento)
                                    <span>$</span>{{ formatoMillares($producto->precio - $producto->descuento) }}
                                    <small class="text-muted"><small><s>${{ formatoMillares($producto->precio) }}</s></small></small><br/>
                                    {{ precioBolivares($producto->precio - $producto->descuento) }}
                                    @else
                                    <span>$</span>{{ formatoMillares($producto->precio) }}<br/>
                                    {{ precioBolivares($producto->precio) }}
                                @endif
                            @else
                                <span>Producto Agotado</span>
                            @endif
                        </div>
                        {!! $producto->descripcion !!}
                        @if ($producto->cant_inventario)
                        <div class="row">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>

                            <a href="#" class="primary-btn" ><i class="fa fa-shopping-cart"></i> Agregar{{--ADD TO CARD--}}</a>
                            <a href="#" id="favoritos_{{ $producto->id }}" content="{{ $producto->id }}"
                               class="heart-icon btn_favoritos @if ($producto->favoritos) fondo-favoritos @endif" style="height: 95%">
                                <span class="icon_heart_alt"></span>
                            </a>
                        </div>
                        @endif
                        <ul>
                            <li><b>SKU</b> <span>{{ $producto->sku }}</span></li>
                            <li><b>Inventario</b> <span>{{ formatoMillares($producto->cant_inventario, 0) }}</span></li>
                            <li><b>Peso</b> <span>{{ formatoMillares($producto->peso) }} {{ $producto->und_peso }}</span></li>
                            <li><b>Categoria</b> <span>{{ ucwords($producto->categorias->nombre) }}</span></li>
                            {{--<li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>--}}

                            {{--<li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>
    <br/>
    <!-- Related Product Section Begin -->
    @if ($relacionados->isNotEmpty())
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Productos Similares</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relacionados as $producto)
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('android.detalles', [Auth::user()->id, $producto->id]) }}">{{ ucwords($producto->nombre) }}</a></h6>
                                @if ($producto->visibilidad && $producto->descuento)
                                    <h5>${{ formatoMillares($producto->precio - $producto->descuento) }}</h5>
                                    <h5>{{ precioBolivares($producto->precio - $producto->descuento) }}</h5>
                                    @else
                                    <h5>${{ formatoMillares($producto->precio) }}</h5>
                                    <h5>{{ precioBolivares($producto->precio) }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                {{--<div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-2.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-3.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('ogani/img/product/product-7.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>--}}

            </div>

        </div>
    </section>
    @endif
    <!-- Related Product Section End -->
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="m-3">
                        <a href="{{ route('android.store.index', Auth::user()->id) }}" class="text-primary"><i class="fa fa-arrow-circle-left"></i> Ir a Store</a>
                    </div>
                </div>
            </div>
        </div>
        <br/>
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
                    if(data.type === "success"){
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }

                }
            });
        });

    </script>
@endsection
