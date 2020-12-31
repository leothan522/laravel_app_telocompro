<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;
    protected $table = "galerias";
    protected $fillable =['productos_id', 'file_path', 'imagen'];

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

}
