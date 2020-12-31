<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $respuesta = verSweetAlert2("hola mundo", 'delete');
        //dd($respuesta);
        return view('admin.dashboard');
    }
}
