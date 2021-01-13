<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Http\Requests\Android\FacturacionEnvioRequest;
use App\Models\Cliente;

class FacturacionController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $cliente = Cliente::where('users_id', $id)->first();
        if ($cliente){
            $id_cliente = $cliente->id;
            $cedula = $cliente->cedula;
            $nombre = $cliente->nombre;
            $apellidos = $cliente->apellidos;
            $telefono = $cliente->telefono;
            $direccion_1 = $cliente->direccion_1;
            $direccion_2 = $cliente->direccion_2;
            $localidad = $cliente->localidad;
            $boton = "Guardar Cambios";
            $class = "btn-primary";
            $opcion = "update";
        }else{
            $id_cliente = null;
            $cedula = null;
            $nombre = null;
            $apellidos = null;
            $telefono = null;
            $direccion_1 = null;
            $direccion_2 = null;
            $localidad = null;
            $boton = "Guardar";
            $class = "btn-success";
            $opcion = "save";
        }
        return view('android.facturacion.index')
            ->with('id_cliente', $id_cliente)
            ->with('cedula', $cedula)
            ->with('nombre', $nombre)
            ->with('apellidos', $apellidos)
            ->with('telefono', $telefono)
            ->with('direccion_1', $direccion_1)
            ->with('direccion_2', $direccion_2)
            ->with('localidad', $localidad)
            ->with('boton', $boton)
            ->with('class', $class)
            ->with('opcion', $opcion);
    }

    public function update(FacturacionEnvioRequest $request, $id)
    {
        $opcion = $request->opcion;
        if ($opcion == "save"){
            $cliente = new Cliente($request->all());
            $cliente->users_id = $id;
            $cliente->save();
            verSweetAlert2('Datos guardados correctamente.');
        }else{
            $cliente = Cliente::find($request->id_cliente);
            $array_db = $cliente->toArray();
            $array_form = $request->all();
            unset($array_form['_token']);
            unset($array_form['opcion']);
            unset($array_form['id_cliente']);
            unset($array_db['id']);
            unset($array_db['codigo_postal']);
            unset($array_db['estados_id']);
            unset($array_db['municipios_id']);
            unset($array_db['parroquias_id']);
            unset($array_db['num_pedidos']);
            unset($array_db['gasto_bs']);
            unset($array_db['gasto_dolar']);
            unset($array_db['ultima_compra']);
            unset($array_db['users_id']);
            unset($array_db['created_at']);
            unset($array_db['updated_at']);
            if (array_diff($array_db, $array_form)){
                $cliente->fill($request->all());
                $cliente->update();
                verSweetAlert2('Datos guardados correctamente.');
            }else{
                //verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                verSweetAlert2('No se realizo ningun cambio.', 'android', 'warning');
            }

        }
        $class = "primary";
        //flash('Datos Guardados Exitosamente', $class)->important();

        return back();
    }
}
