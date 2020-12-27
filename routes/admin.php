<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'user.status', 'isadmin'])->prefix('/admin')->group(function (){

    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::middleware('user.permisos')->group(function (){

        //USuarios
        Route::resource('/usuarios', 'Admin\UsersController');
        Route::get('/usuarios/rol/{role}', 'Admin\UsersController@role')->name('usuarios.role');
        //Clientes
        Route::resource('/clientes', 'Admin\ClientesController');

    });

});
