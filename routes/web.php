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

    //Plantilla Ogani
    Route::get('/shop/grid/', 'Android\AppController@shopGrid')->name('android.shop_grid');
    Route::get('/shop/details/', 'Android\AppController@shopDetails')->name('android.shop_detail');
    Route::get('/shop/cart/', 'Android\AppController@shopCart')->name('android.shop_cart');
    Route::get('/shop/checkout/', 'Android\AppController@shopCheckout')->name('android.shop_checkout');
    Route::get('/shop/home/', 'Android\AppController@shopHome')->name('android.shop_Home');

    // Rutas APP
    Route::get('/ruta/no/definida/{id?}', function () {
        return view('android.prueba');
    })->name('android.no_definida');
    //Principales
    Route::get('/facturacion-envio/{id}', 'Android\FacturacionController@index')->name('android.facturacion.index');
    Route::post('/facturacion-envio/{id}', 'Android\FacturacionController@update')->name('android.facturacion.update');
    Route::get('/store/{id}', 'Android\StoreController@index')->name('android.store.index');
    Route::get('/categorias/{id}/{categoria}/{store?}', 'Android\StoreController@categorias')->name('android.categorias');
    Route::get('/detalles/{id}/{producto}', 'Android\StoreController@detalles')->name('android.detalles');
    Route::get('/favoritos/{id}', 'Android\StoreController@favoritos')->name('android.favoritos');
    Route::get('/carrito/{id}', 'Android\StoreController@carrito')->name('android.carrito');

    //Rutas AJAX
    Route::post('/ajax/favoritos', 'Android\StoreController@ajaxFavoritos')->name('ajax.favoritos');
    Route::post('/ajax/carrito', 'Android\StoreController@ajaxCarrito')->name('ajax.carrito');
    Route::post('/ajax/remover', 'Android\StoreController@ajaxRemover')->name('ajax.remover');


});


