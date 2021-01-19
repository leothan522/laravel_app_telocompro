<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Galeria;
use App\Models\Parametro;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $ultimos_productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('updated_at', 'DESC')->paginate(6);
        $productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('cant_ventas', 'DESC')->paginate(12);
        $productos->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
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
        $ultimos_productos = Producto::where('categorias_id', $categoria)->where('precio', '>', 0)->orderBy('updated_at', 'DESC')->paginate(6);
        $en_oferta = Producto::where('visibilidad', 1)->where('precio', '>', 0)->where('estado', 1)->where('cant_inventario', '>', 0)->orderBy('updated_at', 'DESC')->get();
        $en_oferta->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        $productos = Producto::where('categorias_id', $categoria)->where('precio', '>', 0)->get();
        $productos->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
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
        if (!$detalle->estado || $detalle->precio <= 0){
            return back();
        }

        $detalle->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $detalle->id)->first();
        $galeria = Galeria::where('productos_id', $producto)->get();
        $relacionados = Producto::where('categorias_id', $detalle->categorias_id)->where('id', '!=', $detalle->id)->where('precio', '>', 0)->paginate(4);
        $relacionados->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
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
        if (!$favoritos) {
            $parametros = new Parametro();
            $parametros->nombre = "favoritos";
            $parametros->tabla_id = $id_usuario;
            $parametros->valor = $id_producto;
            $parametros->save();
            $json = ['type' => 'success', 'message' => 'Agregado a tus favoritos.', 'id' => "favoritos_$id_producto", 'clase' => "favoritos_$id_producto"];
        } else {
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
        $favoritos->each(function ($parametro){
            $producto = Producto::find($parametro->valor);
            $parametro->precio = $producto->precio;
            $parametro->estado = $producto->estado;
            $parametro->cant_inventario = $producto->cant_inventario;
            $parametro->visibilidad = $producto->visibilidad;
            $parametro->descuento = $producto->descuento;
            $parametro->file_path = $producto->file_path;
            $parametro->imagen = $producto->imagen;
            $parametro->nombre_producto = $producto->nombre;
        });
        return view('android.store.favoritos')
            ->with('favoritos', $favoritos)
            ->with('i', 1);
    }

    public function carrito($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->get();
        $agrupados = $carrito->groupBy('valor');
        $agrupados->each(function ($parametro){
            $i = 0;

            foreach ($parametro as $producto){
                $i++;
                $parametro->valor = $producto->valor;
                $producto = Producto::find($parametro->valor);
                $parametro->precio = $producto->precio;
                $parametro->estado = $producto->estado;
                $parametro->cant_inventario = $producto->cant_inventario;
                $parametro->visibilidad = $producto->visibilidad;
                $parametro->descuento = $producto->descuento;
                $parametro->file_path = $producto->file_path;
                $parametro->imagen = $producto->imagen;
                $parametro->nombre_producto = $producto->nombre;
                //$parametro->i = $i;
                break;
            }
            $parametro->cantidad = $parametro->count();
            $parametro->subtotal = $parametro->cantidad * $parametro->precio;
        });

        //dd($agrupados->all());
        /*$carrito->each(function ($parametro){
            $producto = Producto::find($parametro->valor);
            $parametro->precio = $producto->precio;
            $parametro->estado = $producto->estado;
            $parametro->cant_inventario = $producto->cant_inventario;
            $parametro->visibilidad = $producto->visibilidad;
            $parametro->descuento = $producto->descuento;
            $parametro->file_path = $producto->file_path;
            $parametro->imagen = $producto->imagen;
            $parametro->nombre_producto = $producto->nombre;
        });*/
        return view('android.store.carrito')
            ->with('carrito', $agrupados)
            ->with('i', 1);
    }

    public function ajaxCarrito(Request $request)
    {
        $json = array();
        $id_usuario = Auth::user()->id;
        $producto = Producto::find($request->id_producto);
        $id_producto = $producto->id;
        $venta_individual = $producto->venta_individual;
        $max = $producto->max_carrito;
        $inventario = $producto->cant_inventario;
        $estado = $producto->estado;
        $precio = $producto->precio;
        $carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->count();
        $json = ['type' => 'success', 'title' => '¡Agregado!', 'message' => '', 'id' => "carrito_$id_producto", 'clase' => "carrito_$id_producto"];
        $parametro = new Parametro();
        $parametro->nombre = "carrito";
        $parametro->tabla_id = $id_usuario;
        $parametro->valor = $id_producto;

        if ($inventario && $estado && $precio > 0) {


            if (!$carrito) {
                $parametro->save();
                $carrito++;
                $json['message'] = "Tienes  en el carrito:<br/><strong>" . cerosIzquierda($carrito) . "</strong> " . ucwords($producto->nombre);
            } else {
                if ($venta_individual) {
                    $json['type'] = "error";
                    $json['title'] = "Venta Individual";
                    $json['message'] = "Solo puedes agregar uno al carrito";
                } else {
                    if (($carrito < $max || !$max) && $carrito < $inventario) {
                        $parametro->save();
                        $carrito++;
                        $json['message'] = "Tienes  en el carrito:<br/><strong>" . cerosIzquierda($carrito) . "</strong> " . ucwords($producto->nombre);
                    } else {
                        if ($carrito == $inventario){
                            $max = $inventario;
                        }
                        $json['type'] = "error";
                        $json['title'] = "Maximo alcanzado";
                        $json['message'] = "Solo puedes agregar <strong>" . cerosIzquierda($max) . "</strong> al carrito";
                    }
                }
            }


        }else{
            $json['type'] = "error";
            $json['title'] = "Producto agotado";
            $json['message'] = "";
        }

        return response()->json($json);
    }

    public function ajaxRemover(Request $request)
    {
        $json = array();
        $id_usuario = Auth::user()->id;
        $id_producto = $request->id_producto;
        $total_actual = $request->total;
        $json = ['type' => 'success', 'title' => '¡Removido!', 'message' => '', 'id' => "remover_$id_producto", 'clase' => "remover_$id_producto"];

        $producto = Producto::find($id_producto);
        $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->get();
        $cantidad = $parametros->count();
        $descontar = $cantidad * $producto->precio;
        foreach ($parametros as $parametro){
            $parametro->delete();
        }
        $json['message'] = ucwords($producto->nombre);
        $json['total'] = formatoMillares($total_actual - $descontar);
        $json['content'] = $total_actual - $descontar;
        $json['bs'] = precioBolivares($total_actual - $descontar);

        return response()->json($json);
    }

}
