<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-cog text-sm"></i> Ajustes</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="ajustes_index" value="true" class="custom-control-input" type="checkbox" id="tituloAjustes"
                           @if (leerJson($user->permisos, 'ajustes.index')) checked @endif>
                    <label for="tituloAjustes" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="ajustes_store" value="true" class="custom-control-input" type="checkbox" id="optionAjustes2"
                       @if (leerJson($user->permisos, 'ajustes.store')) checked @endif>
                <label for="optionAjustes2" class="custom-control-label">Definir Precio del Dolar</label>
            </div>
            {{--<div class="custom-control custom-checkbox">
                <input name="ajustes_clave" value="true" class="custom-control-input" type="checkbox" id="optionAjustes4"
                       @if (leerJson($user->permisos, 'ajustes.clave')) checked @endif>
                <label for="optionAjustes4" class="custom-control-label">Reestablecer Contraseña</label>
            </div>
--}}
        </div>
    </div>
</div>
