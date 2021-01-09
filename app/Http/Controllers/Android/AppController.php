<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
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

    public function getEscritorio($id)
    {
        $this->autenticar($id);
        return view('android.cuenta.escritorio');
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
        //dd
        return view('android.ogani.checkout');
    }

    public function shopHome()
    {
        //$this->autenticar(1);
        //dd(2);
        return view('android.ogani.shop-home');
    }


}
