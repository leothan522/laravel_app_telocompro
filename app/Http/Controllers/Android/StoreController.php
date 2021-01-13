<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Galeria;
use App\Models\Parametro;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $exite = Parametro::where('nombre', 'telefono_numero')->first();
        if ($exite) {
            $telefono_numero = $exite->valor;
        } else {
            $telefono_numero = "(0424) 338.66.00";
        }
        $exite = Parametro::where('nombre', 'telefono_texto')->first();
        if ($exite) {
            $telefono_texto = $exite->valor;
        } else {
            $telefono_texto = "support 24/7 time";
        }

        $categorias = Categoria::orderBy('num_productos', 'DESC')->get();
        $ultimos_productos = Producto::where('estado', 1)->orderBy('updated_at', 'DESC')->paginate(6);
        $productos = Producto::where('estado', 1)->orderBy('cant_ventas', 'DESC')->paginate(12);
        $productos->each(function ($producto){
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        return view('android.store.index')
            ->with('telefono_numero', $telefono_numero)
            ->with('telefono_texto', $telefono_texto)
            ->with('categorias', $categorias)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('productos', $productos)
            ->with('i', 1);
    }

    public function categorias($id, $categoria, $store = null)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $ultimos_productos = Producto::where('categorias_id', $categoria)->orderBy('updated_at', 'DESC')->paginate(6);
        $en_oferta = Producto::where('visibilidad', 1)->orderBy('updated_at', 'DESC')->get();
        $en_oferta->each(function ($producto){
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        $productos = Producto::where('categorias_id', $categoria)->get();
        $productos->each(function ($producto){
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        $total = $productos->count();
        return view('android.store.categorias')
            ->with('store', $store)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('en_oferta', $en_oferta)
            ->with('productos', $productos)
            ->with('total', $total)
            ->with('i', 1);
    }

    public function detalles($id, $producto)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $detalle = Producto::findOrFail($producto);
        $detalle->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $detalle->id)->first();
        $galeria = Galeria::where('productos_id', $producto)->get();
        $relacionados = Producto::where('categorias_id', $detalle->categorias_id)->where('id', '!=', $detalle->id)->paginate(4);
        $relacionados->each(function ($producto){
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        return view('android.store.detalles')
            ->with('producto', $detalle)
            ->with('galeria', $galeria)
            ->with('relacionados', $relacionados);
    }

    public function ajaxFavoritos(Request $request)
    {
        $id_usuario = Auth::user()->id;
        $id_producto = $request->id_producto;
        $favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->first();
        if (!$favoritos){
            $parametros = new Parametro();
            $parametros->nombre = "favoritos";
            $parametros->tabla_id = $id_usuario;
            $parametros->valor = $id_producto;
            $parametros->save();
            $json = ['type' => 'success', 'message' => 'Agregado a tus favoritos.', 'id' => "favoritos_$id_producto", 'clase' => "favoritos_$id_producto"];
        }else{
            $favoritos->delete();
            $json = ['type' => 'error', 'message' => 'Eliminado de tus favoritos', 'id' => "favoritos_$id_producto", 'clase' => "favoritos_$id_producto"];
        }
        return response()->json($json);
    }

    public function favoritos($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->get();
        return view('android.store.favoritos')
            ->with('favoritos', $favoritos)
            ->with('i', 1);
    }
}
