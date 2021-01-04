<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user()){
        return view('welcome');
    }else{
        return redirect()->route('login');
    }
});

Route::middleware(['auth:sanctum', 'verified', 'user.status'])->get('/dashboard', function () {
    //return view('dashboard');
    return view('welcome');
})->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('cerrar');

//**************************************** Ruta para  Usuarios Suspendidos
Route::get('/banned', function () {
    Auth::logout();
    return redirect()->route('login')->with('banned', 'Usuario Suspendido');
})->name('banned');


Route::get('/perfil', function () {
    return view('web.index');
})->name('perfil');


//*************************************************** Rutas App Android
Route::middleware('android')->prefix('/android')->group(function (){

    Route::get('/facturacion-envio/{id}', 'Android\FacturacionEnvioController@getFacturacionEnvio')->name('android.get_facturacion');
    Route::post('/facturacion-envio/{id}', 'Android\FacturacionEnvioController@postFacturacionEnvio')->name('android.post_facturacion');
    Route::get('/escritorio/{id}', 'Android\AppController@getEscritorio')->name('android.get_escritorio');

    //Plantilla Ogani
    Route::get('/shop/grid/', 'Android\AppController@shopGrid')->name('android.shop_grid');
    Route::get('/shop/details/', 'Android\AppController@shopDetails')->name('android.shop_detail');
    Route::get('/shop/cart/', 'Android\AppController@shopCart')->name('android.shop_cart');
    Route::get('/shop/checkout/', 'Android\AppController@shopCheckout')->name('android.shop_checkout');
    Route::get('/shop/home/', 'Android\AppController@shopHome')->name('android.shop_Home');

});


