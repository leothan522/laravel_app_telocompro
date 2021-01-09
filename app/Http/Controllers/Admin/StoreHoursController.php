<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametro;
use Illuminate\Http\Request;

class StoreHoursController extends Controller
{
    public function index()
    {
        $existe = Parametro::where('nombre', 'horarios')->first();
        if ($existe){ $horarios = $existe->valor; }else{ $horarios = 0; }

        $existe = Parametro::where('nombre', 'anulazion_forzada')->first();
        if ($existe){ $anulacion_forzada = $existe->tabla_id; $valor_anulacion_forzada = $existe->valor; }else{ $anulacion_forzada = 0; $valor_anulacion_forzada = 0; }

        $existe = Parametro::where('nombre', 'Mon_open')->first();
        if ($existe){ $lunes_open = $existe->valor; }else{ $lunes_open = null; }
        $existe = Parametro::where('nombre', 'Mon_closed')->first();
        if ($existe){ $lunes_closed = $existe->valor; }else{ $lunes_closed = null; }
        $existe = Parametro::where('nombre', 'Tue_open')->first();
        if ($existe){ $martes_open = $existe->valor; }else{ $martes_open = null; }
        $existe = Parametro::where('nombre', 'Tue_closed')->first();
        if ($existe){ $martes_closed = $existe->valor; }else{ $martes_closed = null; }
        $existe = Parametro::where('nombre', 'Wed_open')->first();
        if ($existe){ $miercoles_open = $existe->valor; }else{ $miercoles_open = null; }
        $existe = Parametro::where('nombre', 'Wed_closed')->first();
        if ($existe){ $miercoles_closed = $existe->valor; }else{ $miercoles_closed = null; }
        $existe = Parametro::where('nombre', 'Thu_open')->first();
        if ($existe){ $jueves_open = $existe->valor; }else{ $jueves_open = null; }
        $existe = Parametro::where('nombre', 'Thu_closed')->first();
        if ($existe){ $jueves_closed = $existe->valor; }else{ $jueves_closed = null; }
        $existe = Parametro::where('nombre', 'Fri_open')->first();
        if ($existe){ $viernes_open = $existe->valor; }else{ $viernes_open = null; }
        $existe = Parametro::where('nombre', 'Fri_closed')->first();
        if ($existe){ $viernes_closed = $existe->valor; }else{ $viernes_closed = null; }
        $existe = Parametro::where('nombre', 'Sat_open')->first();
        if ($existe){ $sabado_open = $existe->valor; }else{ $sabado_open = null; }
        $existe = Parametro::where('nombre', 'Sat_closed')->first();
        if ($existe){ $sabado_closed = $existe->valor; }else{ $sabado_closed = null; }
        $existe = Parametro::where('nombre', 'Sun_open')->first();
        if ($existe){ $domingo_open = $existe->valor; }else{ $domingo_open = null; }
        $existe = Parametro::where('nombre', 'Sun_closed')->first();
        if ($existe){ $domingo_closed = $existe->valor; }else{ $domingo_closed = null; }
        ;

        return view('admin.horarios.index')
            ->with('horarios', $horarios)
            ->with('anulacion_forzada', $anulacion_forzada)
            ->with('valor_anulacion_forzada', $valor_anulacion_forzada)
            ->with('lunes_open', $lunes_open)
            ->with('lunes_closed', $lunes_closed)
            ->with('martes_open', $martes_open)
            ->with('martes_closed', $martes_closed)
            ->with('miercoles_open', $miercoles_open)
            ->with('miercoles_closed', $miercoles_closed)
            ->with('jueves_open', $jueves_open)
            ->with('jueves_closed', $jueves_closed)
            ->with('viernes_open', $viernes_open)
            ->with('viernes_closed', $viernes_closed)
            ->with('sabado_open', $sabado_open)
            ->with('sabado_closed', $sabado_closed)
            ->with('domingo_open', $domingo_open)
            ->with('domingo_closed', $domingo_closed)
            ;
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->parametros('horarios', $request->horarios);
        $this->parametros('anulazion_forzada', $request->valor_anulacion_forzada, $request->anulazion_forzada);
        $this->parametros('Mon_open', $request->lunes_open);
        $this->parametros('Mon_closed', $request->lunes_closed);
        $this->parametros('Tue_open', $request->martes_open);
        $this->parametros('Tue_closed', $request->martes_closed);
        $this->parametros('Wed_open', $request->miercoles_open);
        $this->parametros('Wed_closed', $request->miercoles_closed);
        $this->parametros('Thu_open', $request->jueves_open);
        $this->parametros('Thu_closed', $request->jueves_closed);
        $this->parametros('Fri_open', $request->viernes_open);
        $this->parametros('Fri_closed', $request->viernes_closed);
        $this->parametros('Sat_open', $request->sabado_open);
        $this->parametros('Sat_closed', $request->sabado_closed);
        $this->parametros('Sun_open', $request->domingo_open);
        $this->parametros('Sun_closed', $request->domingo_closed);
        ;
        verSweetAlert2('Cambios guardados correctamente.', 'toast');
        return back();
    }

    public function parametros($nombre, $valor, $tabla_id = null)
    {
        $existe = Parametro::where('nombre', $nombre)->first();

        if ($existe){
            $parametros = Parametro::find($existe->id);
            $parametros->nombre = $nombre;
            $parametros->valor = $valor;
            $parametros->tabla_id = $tabla_id;
            $parametros->update();
        }else{
            $parametros = new Parametro();
            $parametros->nombre = $nombre;
            $parametros->valor = $valor;
            $parametros->tabla_id = $tabla_id;
            $parametros->save();
        }

    }

}
