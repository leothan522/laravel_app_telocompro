<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = "municipios";
    protected $fillable = ['nombre', 'estados_id'];

    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estados_id', 'id');
    }

    public function parroquias()
    {
        return $this->hasMany(Parroquia::class, 'municipios_id', 'id');
    }

}
