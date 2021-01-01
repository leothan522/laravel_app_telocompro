<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::buscar($request->buscar)->orderBy('id', 'DESC')->paginate(30);
        $todos = Cliente::count();
        return view('admin.clientes.index')
            ->with('clientes', $clientes)
            ->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.show')
            ->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit')
            ->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'cedula' => ['required', 'min:6', Rule::unique('clientes')->ignore($id),],
            'nombre' => 'required|min:3',
            'apellidos' => 'required|min:4',
            'direccion_1' => 'required|min:5',
            'localidad' => 'required|min:5'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $cliente = Cliente::find($id);
        $array_db = $cliente->toArray();
        $array_form = $request->all();
        unset($array_form['_token']);
        unset($array_form['opcion']);
        unset($array_form['id_cliente']);
        unset($array_db['id']);
        unset($array_db['codigo_postal']);
        unset($array_db['estados_id']);
        unset($array_db['municipios_id']);
        unset($array_db['parroquias_id']);
        unset($array_db['num_pedidos']);
        unset($array_db['gasto_bs']);
        unset($array_db['gasto_dolar']);
        unset($array_db['ultima_compra']);
        unset($array_db['users_id']);
        unset($array_db['created_at']);
        unset($array_db['updated_at']);
        if (array_diff($array_db, $array_form)){
            $cliente->fill($request->all());
            $cliente->update();
            verSweetAlert2('Cambios guardados correctamente.');
        }else{
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
        }
        $cliente->fill($request->all());
        $cliente->update();
        //flash('Datos Guardados Exitosamente', 'primary')->important();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
