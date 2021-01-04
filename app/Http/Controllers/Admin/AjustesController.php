<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjustesController extends Controller
{
    public function index()
    {
        $parametros = Parametro::where('nombre', 'precio_dolar')->first();
        if ($parametros){
            return view('admin.ajustes.edit')
                ->with('parametros', $parametros);
        }else{
            return view('admin.ajustes.index');
        }

    }

    public function store(Request $request)
    {
        if (!$request->id_parametro){
            $parametros = new Parametro();
            $parametros->nombre = "precio_dolar";
            $parametros->tabla_id = Auth::user()->id;
            $parametros->valor = $request->precio_dolar;
            $parametros->save();
        }else{
            $parametros = Parametro::find($request->id_parametro);
            $taza = $parametros->valor;
            if ($taza == $request->precio_dolar){
                verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                return back();
            }
            $parametros->nombre = "precio_dolar";
            $parametros->tabla_id = Auth::user()->id;
            $parametros->valor = $request->precio_dolar;
            $parametros->update();
        }
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

}
