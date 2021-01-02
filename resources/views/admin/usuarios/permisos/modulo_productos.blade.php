<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-cubes text-sm"></i> Productos</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="productos_index" value="true" class="custom-control-input" type="checkbox" id="tituloProductos"
                           @if (leerJson($user->permisos, 'productos.index')) checked @endif>
                    <label for="tituloProductos" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="productos_create" value="true" class="custom-control-input" type="checkbox" id="opcionProductos1"
                       @if (leerJson($user->permisos, 'productos.create')) checked @endif>
                <label for="opcionProductos1" class="custom-control-label">Añadir nuevo</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="productos_edit" value="true" class="custom-control-input" type="checkbox" id="opcionProductos2"
                       @if (leerJson($user->permisos, 'productos.edit')) checked @endif>
                <label for="opcionProductos2" class="custom-control-label">Editar Productos</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="productos_destroy" value="true" class="custom-control-input" type="checkbox" id="opcionProductos3"
                       @if (leerJson($user->permisos, 'productos.destroy')) checked @endif>
                <label for="opcionProductos3" class="custom-control-label">Eliminar Productos</label>
            </div>
        </div>
    </div>
</div>
