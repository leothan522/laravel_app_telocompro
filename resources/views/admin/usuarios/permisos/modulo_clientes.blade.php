<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-child text-sm"></i> Clientes</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="clientes_index" value="true" class="custom-control-input" type="checkbox" id="tituloCliente"
                           @if (leerJson($user->permisos, 'clientes.index')) checked @endif>
                    <label for="tituloCliente" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="clientes_edit" value="true" class="custom-control-input" type="checkbox" id="optionClientes2"
                       @if (leerJson($user->permisos, 'clientes.edit')) checked @endif>
                <label for="optionClientes2" class="custom-control-label">Editar Datos Clientes</label>
            </div>
            {{--<div class="custom-control custom-checkbox">
                <input name="clientes_clave" value="true" class="custom-control-input" type="checkbox" id="optionClientes4"
                       @if (leerJson($user->permisos, 'clientes.clave')) checked @endif>
                <label for="optionClientes4" class="custom-control-label">Reestablecer Contraseña</label>
            </div>
--}}
        </div>
    </div>
</div>
