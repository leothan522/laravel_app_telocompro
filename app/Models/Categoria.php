<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "categorias";
    protected $fillable =['nombre', 'slug', 'modulo', 'file_path', 'imagen', 'num_productos', 'por_defecto'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categorias_id', 'id');
    }

}
