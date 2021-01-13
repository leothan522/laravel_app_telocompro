<?php
//Funciones Personalizadas para el Proyecto

use App\Models\Parametro;
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
function verSweetAlert2($mensaje, $alert = null, $type = 'success', $icono = '<i class="fa fa-trash-alt"></i>')
{
    switch ($alert) {
        default:
            alert()->success('¡Éxito!', $mensaje)->persistent(true, false);
            break;
        case "iconHtml":
            alert('¡Éxito!', $mensaje, $type)->iconHtml($icono)->persistent(true, false)->toHtml();
            break;
        case "toast":
            toast($mensaje, $type);
        break;
        case "android":
            switch ($type){
                default:
                    alert()->success($mensaje)->toToast();
                break;
                case "info":
                    alert()->info($mensaje)->toToast();
                break;
                case "warning":
                    alert()->warning($mensaje)->toToast();
                break;
                case "error":
                    alert()->error($mensaje)->toToast();
                break;
            }

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

//Precio en bolivares segun taza del dolar
function precioBolivares($precio)
{
    $resultado = null;
    $parametros = Parametro::where('nombre', 'precio_dolar')->first();
    if ($parametros && $precio != null) {
        $resultado = formatoMillares($precio * $parametros->valor) . ' Bs.';
    } else {
        $resultado = "-";
    }
    return $resultado;
}

//Estatus Store Hours
function estadosHorarios($i = null)
{
    $modulo = [
        '1' => "Habilitar",
        '0' => "Inhabilitar"
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

// Formulario en Store Hours
function anulazionForzada($i = null)
{
    $modulo = [
        '1' => "Abierto",
        '0' => "Cerrado",
    ];
    if (is_null($i)) {
        return $modulo;
    } else {
        return $modulo[$i];
    }
}

//Dias activo en Store Hours
function showActive($dia)
{
    $hoy = date('D');
    if ($hoy == $dia) {
        return "show active";
    } else {
        return '';
    }
}
//Estado de Tienda Abierto o Cerrada
function storeHours()
{
    $status = true;
    $horarios = Parametro::where('nombre', 'horarios')->first();
    if ($horarios && $horarios->valor == 1){
        $dia = date('D');
        $open = Parametro::where('nombre', $dia."_open")->first();
        $closed = Parametro::where('nombre', $dia."_closed")->first();
        if ($open->valor && $closed->valor){
            $status = hourIsBetween($open->valor, $closed->valor, date('H:i'));
        }else{
            $status = false;
        }
    }
    $anulazion_forzada = Parametro::where('nombre', 'anulazion_forzada')->first();
    if ($anulazion_forzada && $anulazion_forzada->tabla_id == 1){
        if ($anulazion_forzada->valor == 1){
            $status = true;
        }else{
            $status = false;
        }
    }

    return $status;
}

//Función comprueba una hora entre un rango
function hourIsBetween($from, $to, $input) {
    $dateFrom = DateTime::createFromFormat('!H:i', $from);
    $dateTo = DateTime::createFromFormat('!H:i', $to);
    $dateInput = DateTime::createFromFormat('!H:i', $input);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
    /*En la función lo que haremos será pasarle, el desde y el hasta del rango de horas que queremos que se encuentre y el datetime con la hora que nos llega.
Comprobaremos si la segunda hora que le pasamos es inferior a la primera, con lo cual entenderemos que es para el día siguiente.
Y al final devolveremos true o false dependiendo si el valor introducido se encuentra entre lo que le hemos pasado.*/
}
