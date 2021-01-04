<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-cog text-sm"></i> Store Hours</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="horarios_index" value="true" class="custom-control-input" type="checkbox" id="tituloHorarios"
                           @if (leerJson($user->permisos, 'horarios.index')) checked @endif>
                    <label for="tituloHorarios" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="horarios_store" value="true" class="custom-control-input" type="checkbox" id="optionHorarios2"
                       @if (leerJson($user->permisos, 'horarios.store')) checked @endif>
                <label for="optionHorarios2" class="custom-control-label">Definir Horarios</label>
            </div>
            {{--<div class="custom-control custom-checkbox">
                <input name="horarios_clave" value="true" class="custom-control-input" type="checkbox" id="optionHorarios4"
                       @if (leerJson($user->permisos, 'horarios.clave')) checked @endif>
                <label for="optionHorarios4" class="custom-control-label">Reestablecer Contraseña</label>
            </div>
--}}
        </div>
    </div>
</div>
