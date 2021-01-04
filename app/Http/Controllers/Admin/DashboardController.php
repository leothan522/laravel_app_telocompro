<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametro;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $dolar = (object) array('valor' => '0', 'updated_at' => '');
        $parametros = Parametro::where('nombre', 'precio_dolar')->first();
        if ($parametros){
            $dolar = $parametros;
        }
        $clientes = User::where('role', 0)->count();
        $publicados = Producto::where('estado', 1)->count();
        $agotados = Producto::where('cant_inventario', '<', 1)->orWhere('cant_inventario', null)->count();
        //$agotados = Producto::where('cant_inventario', '<', 1)->orWhere('cant_inventario', null)->count();
        $recientes = Producto::orderBy('id', 'DESC')->paginate(4);
        return view('admin.dashboard')
            ->with('dolar', $dolar)
            ->with('clientes', $clientes)
            ->with('publicados', $publicados)
            ->with('agotados', $agotados)
            ->with('recientes', $recientes);
    }
}
