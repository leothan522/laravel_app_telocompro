<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <span class="text-small text-muted float-right">Android</span>
        </li>
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <a href="{{ route('android.facturacion.index', Auth::user()->id) }}" class="nav-link" target="_blank">
                <i class="fa fa-address-card"></i> Facturación y Envio
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.store.index', Auth::user()->id) }}" class="nav-link" target="_blank">
                <i class="fa fa-store-alt"></i> Store
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.favoritos', Auth::user()->id) }}" class="nav-link" target="_blank">
                <i class="fa fa-heart"></i> Favoritos
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.carrito', Auth::user()->id) }}" class="nav-link" target="_blank">
                <i class="fa fa-shopping-cart"></i> Carrito
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.no_definida', Auth::user()->id) }}" class="nav-link" target="_blank">
                <i class="fa fa-ban"></i> No Definida
            </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <span class="text-small text-muted float-right">Plantilla Ogani</span>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.shop_Home', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.shop_grid', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Shop
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.shop_cart', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Carrito
            </a>
        </li>
        {{--<li class="dropdown-divider"></li>--}}
    </ul>

</div>
