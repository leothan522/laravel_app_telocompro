@extends('layouts.android.master-ogani')

@section('content')
    <!-- Shoping Cart Section Begin -->
    @if (!$carrito->isEmpty())

    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Productos</th>
                                {{--<th>Price</th>--}}
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--<tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-1.jpg') }}" alt="">
                                    <h5>Vegetable’s Package</h5>
                                    $55.00
                                </td>
                                --}}{{--<td class="shoping__cart__price">
                                    $55.00
                                </td>--}}{{--
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $110.00
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-2.jpg') }}" alt="">
                                    <h5>Fresh Garden Vegetable</h5>
                                    $39.00
                                </td>
                                --}}{{--<td class="shoping__cart__price">
                                    $39.00
                                </td>--}}{{--
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $39.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>--}}
                            @php($total = 0)
                            @foreach ($carrito as $parametro)
                                <tr class="remover_{{ $parametro->valor }}">
                                    <td class="{{--shoping__cart__item--}}">
                                        <img src="{{ asset('img/productos/'.$parametro->file_path.'/t_'.$parametro->imagen) }}" class="img-thumbnail" alt="">
                                        <span>{{ ucwords($parametro->nombre_producto) }}</span>
                                        <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">${{ formatoMillares($parametro->precio) }}</span>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" id="valor_{{ $parametro->valor }}" content="{{ $parametro->precio }}" value="{{ $parametro->cantidad }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $<span>{{ formatoMillares($parametro->subtotal) }}</span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" id="remover_{{ $parametro->valor }}" content="{{ $parametro->valor }}"
                                           class="btn_remover {{--@if ($producto->carrito) fondo-favoritos @endif--}}">
                                            <span class="icon_close"></span>
                                        </a>
                                    </td>
                                </tr>
                                @php($total = $total + $parametro->subtotal)
                            @endforeach
                            {{--<tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-3.jpg') }}" class="img-thumbnail" alt="">
                                    <span>Organic Bananas</span>
                                    <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">$699.00</span>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $699.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="#"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-3.jpg') }}" class="img-thumbnail" alt="">
                                    <span>Organic Bananas</span>
                                    <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">$699.00</span>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" content="5">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $699.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="#"><span class="icon_close"></span></a>
                                </td>
                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                {{--<div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>--}}
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Total</h5>
                        <ul>
                            <li><i class="fa fa-dollar"></i> <span id="total_dolar" content="{{ $total }}">${{ formatoMillares($total) }}</span></li>
                            <li>Bs. <span id="total_bs">{{ precioBolivares($total) }}</span></li>
                        </ul>
                        <a href="{{ route('android.shop_checkout') }}" class="primary-btn">PROCEDER A PAGAR</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>
    <!-- Shoping Cart Section End -->
    @else
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
                                <p>¡Tu carrito esta vacio!</p>
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

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn_remover").click(function(e){
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
            var span = document.getElementById('total_dolar');
            var span_bs = document.getElementById('total_bs');
            var total_actual = span.getAttribute('content');
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.remover') }}",
                data: {id_producto:producto, total:total_actual},
                success: function (data) {
                    if(data.content === 0){
                        window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                    }else{

                        Swal.fire({
                            //toast: true,
                            icon: data.type,
                            title: data.title,
                            //text: data.message,
                            html: data.message,
                            //showConfirmButton: false,
                            //confirmButtonColor: '#3085d6',
                        });
                        span.setAttribute('content', data.content);
                        $(span).html('$' + data.total);
                        $(span_bs).html(data.bs);
                        var oferta = document.getElementsByClassName(data.clase);
                        if (oferta) {
                            for (var i = 0; i < oferta.length; i++) {
                                //oferta[i].classList.add('fondo-favoritos');
                                oferta[i].remove();
                            }
                        }
                        //window.location = "{{ route('android.carrito', Auth::user()->id) }}"
                        //document.getElementById(data.id).classList.add('fondo-favoritos');
                    }

                }
            });
        });

    </script>
@endsection
