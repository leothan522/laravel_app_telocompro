<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Parametro;
use App\Models\Producto;
use Illuminate\Http\Request;

class PortadaController extends Controller
{
    public function index()
    {
        $exite = Parametro::where('nombre', 'telefono_numero')->first();
        if ($exite){ $telefono_numero = $exite; }else{ $telefono_numero = "(0424) 338.66.00"; }
        $exite = Parametro::where('nombre', 'telefono_texto')->first();
        if ($exite){ $telefono_texto = $exite; }else{ $telefono_texto = "support 24/7 time"; }

        $categorias = Categoria::orderBy('num_productos', 'DESC')->get();
        $ultimos_productos = Producto::where('estado', 1)->orderBy('updated_at', 'DESC')->paginate(6);
        ;
        return view('android.store.portada')
            ->with('telefono_numero', $telefono_numero)
            ->with('telefono_texto', $telefono_texto)
            ->with('categorias', $categorias)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('i', 1);
    }
}
