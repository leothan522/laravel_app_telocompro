<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "productos";
    protected $fillable = ['nombre', 'slug', 'sku', 'descripcion', 'categorias_id', 'precio', 'cant_inventario',
                            'cant_ventas', 'poca_existencia', 'peso', 'und_peso', 'venta_individual', 'max_carrito',
                            'file_path', 'imagen', 'estado', 'visibilidad', 'descuento'];

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id', 'id');
    }

    public function galerias()
    {
        return $this->hasMany(Galeria::class, 'productos_id', 'id');
    }

    public function parametros()
    {
        return $this->hasMany(Parametro::class, 'valor', 'id');
    }

    public function scopeBuscar($query, $name)
    {
        return $query->where('nombre', 'LIKE', "%$name%");
    }

}
