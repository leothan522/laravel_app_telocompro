<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <span class="text-small text-muted float-right">Android</span>
        </li>
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <a href="{{ route('android.get_facturacion', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Facturación y Envio
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.get_escritorio', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Escritorio
            </a>
        </li>
        {{--<li class="dropdown-divider"></li>--}}
    </ul>

</div>
