<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clave = Str::random(8);
        $users = User::buscar($request->buscar)->orderBy('id', 'DESC')->paginate(30);
        $todos = User::count();
        $administrador = User::where('role', 2)->count();
        $gestor = User::where('role', 1)->count();
        $cliente = User::where('role', 0)->count();
        return view('admin.usuarios.index')
            ->with('users', $users)
            ->with('clave', $clave)
            ->with('role', 100)
            ->with('todos', $todos)
            ->with('administrador', $administrador)
            ->with('gestor', $gestor)
            ->with('cliente', $cliente);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        //flash('Registrado Exitosamente', 'success')->important();
        verSweetAlert2('Usuario creado correctamente.');
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.usuarios.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.usuarios.permisos')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        switch ($request->mod) {

            case "status":
                if ($user->status > 0) {
                    $user->status = 0;
                    $tipo = "error";
                    $icono = '<i class="fas fa-user-slash"></i>';
                    $mensaje = 'Usuario Suspendido.';
                } else {
                    $user->status = 1;
                    $tipo = "success";
                    $icono = '<i class="fas fa-user-check"></i>';
                    $mensaje = 'Usuario activado.';
                }
                $user->save();
                //flash($icono.' '.$mensaje, $tipo)->important();
                verSweetAlert2($mensaje, 'iconHtml', $tipo, $icono);
                return redirect()->route('usuarios.show', $id);
                break;

            case 'clave':
                $nueva_clave = Str::random(8);
                $user->password = Hash::make($nueva_clave);
                $user->update();
                verSweetAlert2('Nueva Contraseña generada correctamente', 'toast', 'success');
                return back()->with('nueva_clave', $nueva_clave);
                break;

            case "permisos":

                $permisos = [
                    'usuarios.index' => $request->input('usuarios_index'),
                    'usuarios.role' => $request->input('usuarios_index'),
                    'usuarios.create' => $request->input('usuarios_create'),
                    'usuarios.store' => $request->input('usuarios_store'),
                    'usuarios.status' => $request->input('usuarios_status'),
                    'usuarios.editar' => $request->input('usuarios_editar'),
                    'usuarios.clave' => $request->input('usuarios_clave'),
                    'usuarios.edit' => $request->input('usuarios_edit'),
                    'clientes.index' => $request->input('clientes_index'),
                    'clientes.show' => $request->input('clientes_index'),
                    'clientes.edit' => $request->input('clientes_edit'),
                    'clientes.update' => $request->input('clientes_edit'),
                    'categorias.index' => $request->input('categorias_index'),
                    'categorias.modulo' => $request->input('categorias_index'),
                    'categorias.store' => $request->input('categorias_store'),
                    'categorias.edit' => $request->input('categorias_edit'),
                    'categorias.update' => $request->input('categorias_edit'),
                    'categorias.destroy' => $request->input('categorias_destroy'),
                    'productos.index' => $request->input('productos_index'),
                    'productos.filtrar' => $request->input('productos_index'),
                    'productos.ver' => $request->input('productos_index'),
                    'productos.create' => $request->input('productos_create'),
                    'productos.store' => $request->input('productos_create'),
                    'productos.edit' => $request->input('productos_edit'),
                    'productos.update' => $request->input('productos_edit'),
                    'productos.galeria_add' => $request->input('productos_edit'),
                    'productos.galeria_delete' => $request->input('productos_edit'),
                    'productos.acciones_lote' => $request->input('productos_edit'),
                    'productos.destroy' => $request->input('productos_destroy'),
                    'ajustes.index' => $request->input('ajustes_index'),
                    'ajustes.store' => $request->input('ajustes_index'),
                    'horarios.index' => $request->input('horarios_index'),
                    'horarios.store' => $request->input('horarios_index'),
                ];
                //******************************************** Usuarios SIDEBAR
                if ($permisos['usuarios.index']) {
                    $permisos['configuracion'] = "true";
                } else {
                    $permisos['configuracion'] = null;
                }
                //******************************************** ver Usuario / Suspender / Editar / Resstablecer Clave
                if ($permisos['usuarios.status'] || $permisos['usuarios.editar'] || $permisos['usuarios.clave']) {
                    $permisos['usuarios.show'] = "true";
                    $permisos['usuarios.update'] = "true";
                } else {
                    $permisos['usuarios.show'] = null;
                    $permisos['usuarios.update'] = null;
                }
                //******************************************** Permisos de Usuario
                if ($permisos['usuarios.edit']) {
                    $permisos['usuarios.update'] = "true";
                }

                //******************************************** E-commerce SIDEBAR
                if ($permisos['clientes.index'] || $permisos['ajustes.index'] || $permisos['horarios.index']){
                    $permisos['e-commerce'] = "true";
                }else{
                    $permisos['e-commerce'] = null;
                }

                //******************************************** Productos SIDEBAR
                if ($permisos['categorias.index'] || $permisos['productos.index']){
                    $permisos['productos'] = "true";
                }else{
                    $permisos['productos'] = null;
                }

                $permisos = json_encode($permisos);
                if ($permisos == $user->permisos){
                    verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                    return back();
                }
                $user->permisos = $permisos;
                $user->update();
                //flash('Permisos Actualizados', 'primary')->important();
                verSweetAlert2('Permisos del usuario actualizados.');
                return back();

                break;

            default:

                $name = $user->name;
                $email = $user->email;
                $role = $user->role;
                $plataforma = $user->plataforma;

                if ($plataforma == 0) {
                    //Navegador
                    $rules = [
                        'name' => 'required|min:8',
                        'email' => ['required', 'email', Rule::unique('users')->ignore($id),],
                    ];
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    if ($name == $request->name && $email == $request->email && $role == $request->role) {
                        //flash('No se realizo ningun cambio', 'warning')->important();
                        verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                        return back();
                    } else {

                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->role = $request->role;
                        if ($email != $request->email) {
                            $user->status = 1;
                        }
                        $user->update();
                        //flash('Datos guardados correctamente', 'success')->important();
                        verSweetAlert2('Cambios guardados correctamente.');
                        return back();

                    }

                } else {
                    //android

                    if ($role == $request->role) {
                        //flash('No se realizo ningun cambio', 'warning')->important();
                        verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                        return back();
                    } else {

                        $user->role = $request->role;
                        $user->update();
                        //flash('Datos guardados correctamente', 'success')->important();
                        verSweetAlert2('Cambios guardados correctamente.');
                        return back();

                    }

                }


                break;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function role($role)
    {
        $clave = Str::random(8);
        $users = User::where('role', $role)->orderBy('id', 'DESC')->paginate(30);
        $todos = User::count();
        $administrador = User::where('role', 2)->count();
        $gestor = User::where('role', 1)->count();
        $cliente = User::where('role', 0)->count();
        if (is_numeric($role) && $role >= 0 && $role <= 2){
            return view('admin.usuarios.index')
                ->with('users', $users)
                ->with('clave', $clave)
                ->with('role', $role)
                ->with('todos', $todos)
                ->with('administrador', $administrador)
                ->with('gestor', $gestor)
                ->with('cliente', $cliente);
        }else{
            return redirect()->route('usuarios.index');
        }

    }
}
