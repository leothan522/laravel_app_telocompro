<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-tags text-sm"></i> Categorias</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="categorias_index" value="true" class="custom-control-input" type="checkbox" id="tituloCategorias"
                           @if (leerJson($user->permisos, 'categorias.index')) checked @endif>
                    <label for="tituloCategorias" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="categorias_store" value="true" class="custom-control-input" type="checkbox" id="opcionCategorias1"
                       @if (leerJson($user->permisos, 'categorias.store')) checked @endif>
                <label for="opcionCategorias1" class="custom-control-label">Crear Categorias</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="categorias_edit" value="true" class="custom-control-input" type="checkbox" id="opcionCategorias2"
                       @if (leerJson($user->permisos, 'categorias.edit')) checked @endif>
                <label for="opcionCategorias2" class="custom-control-label">Editar Categorias</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="categorias_destroy" value="true" class="custom-control-input" type="checkbox" id="opcionCategorias3"
                       @if (leerJson($user->permisos, 'categorias.destroy')) checked @endif>
                <label for="opcionCategorias3" class="custom-control-label">Eliminar Categorias</label>
            </div>
        </div>
    </div>
</div>
