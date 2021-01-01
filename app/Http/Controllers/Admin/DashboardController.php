<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        alert()->success('¡Éxito!','Lorem ipsum dolor sit amet.')->persistent(true,false);
        return view('admin.dashboard');
    }
}
