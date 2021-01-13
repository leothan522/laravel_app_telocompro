<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriasRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('nombre', 'ASC')->paginate(30);
        $todas = Categoria::count();
        $productos = Categoria::where('modulo', 0)->count();
        $blog = Categoria::where('modulo', 1)->count();
        return view('admin.categorias.index')
            ->with('categorias', $categorias)
            ->with('todas', $todas)
            ->with('productos', $productos)
            ->with('blog', $blog)
            ->with('modulo', 100);
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
    public function store(CategoriasRequest $request)
    {
        $path = "/img/categorias";
        $file = $request->imagen;
        if ($request->hasFile('imagen')){
            $uploads = subirArchivos($file, $path);
            $miniatura = crearMiniaturas($path, $uploads->getPathName(), $uploads->getFileName());
        }

        $categoria = new Categoria($request->all());
        $categoria->nombre = ucwords(e($request->nombre));
        $categoria->slug = Str::slug($request->nombre.' '.rand(1, 999));
        $categoria->modulo = $request->modulo;
        if ($request->hasFile('imagen')) {
            $categoria->file_path = date('Y-m-d');
            $categoria->imagen = $uploads->getFileName();
        }
        $categoria->save();

        //flash('Categoria Creada Correctamente', 'success')->important();
        verSweetAlert2('Categoria creada correctamente.');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit')
            ->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $file_path = $categoria->file_path;
        $file_name = $categoria->imagen;
        $db_nombre = $categoria->nombre;
        $db_modulo = $categoria->modulo;

        $path = "/img/categorias";
        $file = $request->imagen;
        if ($request->hasFile('imagen')){
            if (!is_null($file_name)){
                $borrar_imagen = borrarArchivos($path, $file_path, $file_name);
                $borrar_miniuatura = borrarArchivos($path, $file_path, 't_'.$file_name);
            }
            $uploads = subirArchivos($file, $path);
            $miniatura = crearMiniaturas($path, $uploads->getPathName(), $uploads->getFileName());
        }

        if ($db_nombre == $request->nombre && $db_modulo == $request->modulo && !$request->hasFile('imagen')){
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
            return back();
        }

        $categoria->nombre = ucwords(e($request->nombre));
        $categoria->slug = Str::slug($request->nombre.' '.rand(1, 999));
        $categoria->modulo = $request->modulo;
        if ($request->hasFile('imagen')) {
            $categoria->file_path = date('Y-m-d');
            $categoria->imagen = $uploads->getFileName();
        }
        $categoria->update();

        //flash('Cambios Guardados Correctamente', 'primary')->important();
        verSweetAlert2('Cambios guardados correctamente.');
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
        $por_defecto = Categoria::where('por_defecto', 1)->first();
        $categoria = Categoria::find($id);
        $nombre = strtoupper($categoria->nombre);
        /*$file_path = $categoria->file_path;
        $file_name = $categoria->imagen;
        $path = "/img/categorias";
        $borrar_imagen = borrarArchivos($path, $file_path, $file_name);
        $borrar_miniuatura = borrarArchivos($path, $file_path, 't_'.$file_name);*/
        $productos = Producto::where('categorias_id', $categoria->id)->get();
        foreach ($productos as $producto){
            $cambiar = Producto::find($producto->id);
            $cambiar->categorias_id = $por_defecto->id;
            $cambiar->update();
            $por_defecto->num_productos = $por_defecto->num_productos + 1;
            $por_defecto->update();
        }
        $categoria->delete();

        //flash("Borrada la Categoria <strong>$nombre</strong>", 'danger')->important();
        verSweetAlert2("Borrada la categoría <strong class='text-danger'>$nombre</strong>", 'iconHtml', 'error');
        return back();
    }

    public function modulo($modulo)
    {
        $categorias = Categoria::where('modulo', $modulo)->orderBy('nombre', 'ASC')->paginate(30);
        $todas = Categoria::count();
        $productos = Categoria::where('modulo', 0)->count();
        $blog = Categoria::where('modulo', 1)->count();
        if(is_numeric($modulo) && $modulo >= 0 && $modulo <= 1){
            return view('admin.categorias.index')
                ->with('categorias', $categorias)
                ->with('todas', $todas)
                ->with('productos', $productos)
                ->with('blog', $blog)
                ->with('modulo', $modulo);
        }else{
            return redirect()->route('categorias.index');
        }

    }


}
