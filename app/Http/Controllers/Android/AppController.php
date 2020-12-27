<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Http\Requests\Android\FacturacionEnvioRequest;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class AppController extends Controller
{

    public function autenticar($id)
    {
        $user = User::findOrFail($id);
        Auth::loginUsingId($user->id, true);
    }

    public function getFacturacionEnvio($id)
    {
        $this->autenticar($id);
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
        return view('android.cuenta.facturacion_envio')
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

    public function postFacturacionEnvio(FacturacionEnvioRequest $request, $id)
    {
        $opcion = $request->opcion;
        if ($opcion == "save"){
            $cliente = new Cliente($request->all());
            $cliente->users_id = $id;
            $cliente->save();
            $class = "success";
        }else{
            $cliente = Cliente::find($request->id_cliente);
            $cliente->fill($request->all());
            $cliente->update();
            $class = "primary";
        }
        flash('Datos Guardados Exitosamente', $class)->important();
        return back();
    }

    public function getEscritorio($id)
    {
        $this->autenticar($id);
        $user = User::find($id);
        return view('android.cuenta.escritorio')
            ->with('user', $user);
    }

    public function shopGrid()
    {
        return view('android.ogani.shop-grid');
    }

    public function shopdetails()
    {
        return view('android.ogani.shop-details');
    }

    public function shopCart()
    {
        return view('android.ogani.shoping-cart');
    }

    public function shopCheckout()
    {
        return view('android.ogani.checkout');
    }


}
