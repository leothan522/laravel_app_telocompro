<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Parametro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AppController extends Controller
{

    public function autenticar($id)
    {
        $user = User::findOrFail($id);
        return Auth::loginUsingId($user->id, true);
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
        //dd(100);
        return view('android.ogani.shoping-cart');
    }

    public function shopCheckout()
    {
        $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->get();
        foreach ($parametros as $parametro){
            $parametro->delete();
        }
        verSweetAlert2('Carrito Vacio', 'android', 'warning');
        return view('android.ogani.checkout');
    }

    public function shopHome()
    {
        //$this->autenticar(1);
        //dd(2);
        return view('android.ogani.shop-home');
    }


}
