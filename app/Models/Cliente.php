<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    protected $fillable = [
        'cedula', 'nombre', 'apellidos', 'telefono', 'direccion_1', 'direccion_2', 'localidad',
        'codigo_postal', 'estados_id', 'municipios_id', 'parroquias_id', 'users_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
