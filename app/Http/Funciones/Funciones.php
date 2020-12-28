<?php
//Funciones Personalizadas para el Proyecto

use Carbon\Carbon;

function hola()
{
    return "Funciones Personalidas bien creada";
}

function status($i)
{
    $status = [
        '0' => '<span class="text-danger">Suspendido</span>',
        '1' => '<span class="text-primary">Activo</span>',
        '2' => '<span class="text-success">Confirmado</span>'
    ];
    return $status[$i];
}

function role($i = null)
{
    $status = [
        '0' => 'Cliente',
        '1' => 'Gestor de Tienda',
        '2' => 'Administrador',
        '100' => 'Root'
    ];
    if (is_null($i)) {
        unset($status["100"]);
        return $status;
    } else {
        return $status[$i];
    }
}

function haceCuanto($fecha)
{
    $carbon = new Carbon();
    if ($fecha != null) {
        return $carbon->parse($fecha)->diffForHumans();
    } else {
        return "-";
    }

}

function iconoPlataforma($plataforma)
{
    if ($plataforma == 0) {
        return '<i class="fas fa-desktop"></i>';
    } else {
        return '<i class="fas fa-mobile"></i>';
    }
}

//Leer JSON
function leerJson($json, $key)
{
    if ($json == null) {
        return null;
    } else {
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)) {
            return $json[$key];
        } else {
            return null;
        }
    }
}

//funcion formato millares
function formatoMillares($cantidad, $decimal = 2)
{
    return number_format($cantidad, $decimal, ',', '.');
}

//Ceros a la izquierda
function cerosIzquierda($cantidad, $cantCeros = 2)
{
    if ($cantidad == 0) {
        return 0;
    }
    return str_pad($cantidad, $cantCeros, "0", STR_PAD_LEFT);
}

//calculo de porcentaje
function obtenerPorcentaje($cantidad, $total)
{
    if ($total != 0) {
        $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
        $porcentaje = round($porcentaje, 2);  // Quitar los decimales
        return $porcentaje;
    }
    return 0;
}

//Modulo para las categorias
function moduloCategoria($i = null)
{
    $modulo = [
        '0' => "Productos",
        '1' => "Blog"
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

//Manejo de Archivos
function subirArchivos($file, $path)
{
    $fileExt = trim($file->getCLientOriginalExtension());
    $upload_path = public_path() . '' . $path . '/' . date('Y-m-d');
    $name = Str::slug(str_replace($fileExt, '', $file->getClientOriginalName()));
    $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;
    return $file->move($upload_path, $fileName);
}

//crear Imagenes Miniaturas
function crearMiniaturas($path, $file_path, $file_name)
{
    $upload_path = public_path() . '' . $path . '/' . date('Y-m-d');
    $img = Image::make($file_path);
    $img->fit(256, 256, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    $img->save($upload_path . '/t_' . $file_name);
    return $img;
}

//Borrar archivos
function borrarArchivos($path, $file_path, $file_name)
{
    return unlink(public_path() . '' . $path . '/' . $file_path . '/' . $file_name);
}

