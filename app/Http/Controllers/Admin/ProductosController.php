<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductosRequest;
use App\Models\Categoria;
use App\Models\Galeria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('admin.productos.create')
            ->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductosRequest $request)
    {
        //dd($request->all());
        $path = "/img/productos";
        $file = $request->imagen;
        if ($request->hasFile('imagen')){
            $uploads = subirArchivos($file, $path);
            $miniatura = crearMiniaturas($path, $uploads->getPathName(), $uploads->getFileName());
        }

        $producto = new Producto($request->all());
        $producto->sku = strtoupper($request->sku);
        $producto->slug = Str::slug($request->nombre);
        if ($request->hasFile('imagen')){
            $producto->file_path = date("Y-m-d");
            $producto->imagen = $uploads->getFileName();
        }
        $producto->save();

        //flash('Producto Creado Correctamente', 'success')->important();
        verSweetAlert2('Producto creado correctamente.');
        return redirect()->route('productos.edit', $producto->id);
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
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('admin.productos.edit')
            ->with('categorias', $categorias)
            ->with('producto', $producto);
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
        $producto = Producto::find($id);
        $path = "/img/productos";
        $file_path = $producto->file_path;
        $file_name = $producto->imagen;
        $file = $request->imagen;

        if ($request->hasFile('imagen')){
            if (!is_null($file_name)){
                $borrar_imagen = borrarArchivos($path, $file_path, $file_name);
                $borrar_miniuatura = borrarArchivos($path, $file_path, 't_'.$file_name);
            }
            $uploads = subirArchivos($file, $path);
            $miniatura = crearMiniaturas($path, $uploads->getPathName(), $uploads->getFileName());
        }

        $array_db = $producto->toArray();
        $array_form = $request->all();
        unset($array_form['_token']);
        unset($array_form['_method']);
        if (!$request->venta_individual){
            $array_form['venta_individual'] = 0;
        }
        unset($array_db['id']);
        unset($array_db['created_at']);
        unset($array_db['updated_at']);
        unset($array_db['deleted_at']);
        unset($array_db['file_path']);
        unset($array_db['imagen']);
        unset($array_db['cant_ventas']);
        unset($array_db['slug']);

        $individual = $producto->venta_individual;
        $producto->fill($request->all());
        if ($request->hasFile('imagen')){
            $producto->file_path = date("Y-m-d");
            $producto->imagen = $uploads->getFileName();
        }
        if (!$request->venta_individual && $individual == 1){
            $producto->venta_individual = 0;
        }

        if (array_diff_assoc($array_db, $array_form) || $request->hasFile('imagen')){
            $producto->update();
            //flash('Producto Actualizado Correctamente', 'primary')->important();
            verSweetAlert2('Cambios guardados correctamente.');
        }else{
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
        }

        return redirect()->route('productos.edit', $producto->id);
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

    public function galeriaAdd(Request $request, $id)
    {
        $producto = Producto::find($id);

        $path = "/img/productos_galeria";
        $file = $request->imagen;
        if ($request->hasFile('imagen')){
            $uploads = subirArchivos($file, $path);
            $miniatura = crearMiniaturas($path, $uploads->getPathName(), $uploads->getFileName());
        }

        $galeria = new Galeria();
        $galeria->productos_id = $producto->id;
        $galeria->file_path = date("Y-m-d");
        $galeria->imagen = $uploads->getFileName();
        $galeria->save();

        //flash("Imagen Agregada a la Galeria del Producto", 'primary')->important();
        verSweetAlert2('Imagen agregada a la galeria del producto.');
        return back();

    }

    public function galeriaDelete($id, $gid)
    {
        $galeria = Galeria::findOrFail($gid);
        $path = "/img/productos_galeria";
        $file_path = $galeria->file_path;
        $file_name = $galeria->imagen;
        if ($galeria->productos_id == $id){
            $galeria->delete();
            borrarArchivos($path, $file_path, $file_name);
            borrarArchivos($path, $file_path, 't_'.$file_name);
            //flash('Imagen Borrada de la Galeria del Producto', 'danger')->important();
            verSweetAlert2('Imagen borrada de la galeria del producto', 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
            return back();
        }else{
            //flash('la Imagen NO se puede Borrar', 'warning')->important();
            verSweetAlert2('la imagen NO se puede borrar.', 'toast', 'error');
            return back();
        }
    }
}
