<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;
    protected $table = "parametros";
    protected $fillable = ['nombre', 'tabla_id', 'valor'];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'tabla_id', 'id');
    }

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'valor', 'id');
    }

}
