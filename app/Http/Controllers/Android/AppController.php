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
        Auth::loginUsingId($user->id, true);
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

    public function shopHome()
    {
        return view('android.ogani.shop-home');
    }


}
