<?php
//Funciones Personalizadas para el Proyecto

use Carbon\Carbon;

function hola()
{
    //alert()->success('¡Éxito!','Lorem ipsum dolor sit amet.')->persistent(true,false);
    //return "Funciones Personalidas bien creada";
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
    $img->resize(270, 270, function ($constraint) {
        //$constraint->aspectRatio();
        //$constraint->upsize();
    });
    $img->save($upload_path . '/t_' . $file_name);
    return $img;
}

//Borrar archivos
function borrarArchivos($path, $file_path, $file_name)
{
    return unlink(public_path() . '' . $path . '/' . $file_path . '/' . $file_name);
}

//Estados de los Productos
function estadoProducto($i = null)
{
    $modulo = [
        '0' => "Borrador",
        '1' => "Publicado"
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

//Visibilidad de los Productos
function visibilidadProducto($i = null)
{
    $modulo = [
        '0' => "Publico",
        '1' => "Privado"
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

//Unidades de Peso
function undPeso($i = null)
{
    $modulo = [
        'Kg.' => "Kilogramos",
        'Lt.' => "Litros"
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

//Alertas de sweetAlert2
function verSweetAlert2($mensaje, $alert = null, $type = 'success', $icono = '<i class="far fa-thumbs-up"></i>')
{
    switch ($alert){
        default:
            alert()->success('¡Éxito!',$mensaje)->persistent(true,false);
        break;
        case "iconHtml":
            alert('¡Éxito!', $mensaje, $type)->iconHtml($icono)->persistent(true,false)->toHtml();
        break;
        case "toast":
            toast($mensaje, $type);
        break;
        case "delete":
            alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusCancel(true);
        break;
    }
    /*alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');
        alert()->warning('WarningAlert','Lorem ipsum dolor sit amet.');
        alert()->error('ErrorAlert','Lorem ipsum dolor sit amet.');
        alert()->question('QuestionAlert','Lorem ipsum dolor sit amet.');
        toast('Success Toast','success');.
        // example:
        alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->addImage('https://unsplash.it/400/200');
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->width('720px');
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->padding('50px');
        */
    // example:
    //alert()->success('¡Éxito!',$mensaje)->persistent(true,false);
    // example:
    //alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton('Cancel', '#aaa');
    // example:
    //toast('Post Updated','success','top-right')->showCloseButton();
    // example:
    //toast('Post Updated','success','top-right')->hideCloseButton();
    // example:
    /*alert()->question('Are you sure?','You won\'t be able to revert this!')
        ->showConfirmButton('Yes! Delete it', '#3085d6')
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();*/

    // example:
    // alert()->error('Oops...', 'Something went wrong!')->footer('<a href="#">Why do I have this issue?</a>');
    // example:
    //alert()->success('Post Created', 'Successfully')->toToast();
    // example:
    //alert('Title','Lorem Lorem Lorem', 'success')->background('#2acc56');
    // example:
    //()->success('Post Created', 'Successfully')->buttonsStyling(false);
    // example:
    //alert()->success('Post Created', 'Successfully')->iconHtml('<i class="far fa-thumbs-up"></i>');
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusConfirm(true);
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusCancel(true);
    // example:
    //toast('Signed in successfully','success')->timerProgressBar();

}

